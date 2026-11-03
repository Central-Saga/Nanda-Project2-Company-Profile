"use server";

import { prisma } from "@/lib/prisma";
import bcrypt from "bcryptjs";
import { cookies } from "next/headers";
import { loginSchema, changePasswordSchema } from "@/lib/validations/auth";
import { createSessionToken, hashToken } from "@/lib/session";
import { getCurrentUser, requireAuth } from "@/lib/auth";

export interface ActionState {
  success: boolean;
  message?: string;
  errors?: Record<string, string[]>;
  redirectUrl?: string;
}

export async function loginAction(_prevState: ActionState | null, formData: FormData): Promise<ActionState> {
  const rawData = {
    email: formData.get("email"),
    password: formData.get("password"),
  };

  const parsed = loginSchema.safeParse(rawData);
  if (!parsed.success) {
    return {
      success: false,
      errors: parsed.error.flatten().fieldErrors,
    };
  }

  const { email, password } = parsed.data;

  const user = await prisma.user.findUnique({
    where: { email },
    include: { role: true },
  });

  if (!user || !user.isActive || user.deletedAt) {
    return {
      success: false,
      message: "Email atau password salah",
    };
  }

  if (user.lockedUntil && user.lockedUntil > new Date()) {
    return {
      success: false,
      message: "Akun terkunci sementara karena percobaan login berulang. Silakan coba nanti.",
    };
  }

  const isPasswordValid = await bcrypt.compare(password, user.passwordHash);
  if (!isPasswordValid) {
    const updatedFailed = user.failedLoginCount + 1;
    let lockedUntil: Date | null = null;
    if (updatedFailed >= 5) {
      lockedUntil = new Date(Date.now() + 15 * 60 * 1000); // Lock 15 mins
    }

    await prisma.user.update({
      where: { id: user.id },
      data: {
        failedLoginCount: updatedFailed,
        lockedUntil,
      },
    });

    return {
      success: false,
      message: "Email atau password salah",
    };
  }

  // Create DB Session
  const sessionRecord = await prisma.session.create({
    data: {
      userId: user.id,
      tokenHash: "temp_hash",
      expiresAt: new Date(Date.now() + 24 * 60 * 60 * 1000), // 24 hours
    },
  });

  const token = await createSessionToken({
    userId: user.id,
    role: user.role.name,
    sessionId: sessionRecord.id,
    mustChangePassword: user.mustChangePassword,
  });

  const hashedToken = hashToken(token);
  await prisma.session.update({
    where: { id: sessionRecord.id },
    data: { tokenHash: hashedToken },
  });

  // Reset failed login & update last login
  await prisma.user.update({
    where: { id: user.id },
    data: {
      failedLoginCount: 0,
      lockedUntil: null,
      lastLoginAt: new Date(),
    },
  });

  // Set HTTP-Only Cookie
  const cookieStore = await cookies();
  cookieStore.set("session_token", token, {
    httpOnly: true,
    secure: process.env.NODE_ENV === "production",
    sameSite: "lax",
    path: "/",
    maxAge: 24 * 60 * 60,
  });

  // Audit log
  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "LOGIN",
      entityType: "User",
      entityId: user.id,
      newValues: { email: user.email },
    },
  });

  if (user.mustChangePassword) {
    return {
      success: true,
      redirectUrl: "/admin/change-password",
    };
  }

  return {
    success: true,
    redirectUrl: "/admin/dashboard",
  };
}

export async function changePasswordAction(_prevState: ActionState | null, formData: FormData): Promise<ActionState> {
  const user = await requireAuth();

  const rawData = {
    currentPassword: formData.get("currentPassword"),
    newPassword: formData.get("newPassword"),
    confirmPassword: formData.get("confirmPassword"),
  };

  const parsed = changePasswordSchema.safeParse(rawData);
  if (!parsed.success) {
    return {
      success: false,
      errors: parsed.error.flatten().fieldErrors,
    };
  }

  const { currentPassword, newPassword } = parsed.data;

  const dbUser = await prisma.user.findUnique({
    where: { id: user.id },
  });

  if (!dbUser) {
    return { success: false, message: "User tidak ditemukan" };
  }

  const isCurrentValid = await bcrypt.compare(currentPassword, dbUser.passwordHash);
  if (!isCurrentValid) {
    return {
      success: false,
      errors: {
        currentPassword: ["Password saat ini salah"],
      },
    };
  }

  const newHash = await bcrypt.hash(newPassword, 12);

  await prisma.user.update({
    where: { id: user.id },
    data: {
      passwordHash: newHash,
      mustChangePassword: false,
      passwordChangedAt: new Date(),
    },
  });

  // Refresh token with mustChangePassword = false
  const newToken = await createSessionToken({
    userId: user.id,
    role: user.role,
    sessionId: user.sessionId,
    mustChangePassword: false,
  });

  const hashedToken = hashToken(newToken);
  await prisma.session.update({
    where: { id: user.sessionId },
    data: { tokenHash: hashedToken },
  });

  const cookieStore = await cookies();
  cookieStore.set("session_token", newToken, {
    httpOnly: true,
    secure: process.env.NODE_ENV === "production",
    sameSite: "lax",
    path: "/",
    maxAge: 24 * 60 * 60,
  });

  await prisma.auditLog.create({
    data: {
      userId: user.id,
      action: "UPDATE",
      entityType: "UserPassword",
      entityId: user.id,
      newValues: { action: "password_changed" },
    },
  });

  return {
    success: true,
    message: "Password berhasil diperbarui",
    redirectUrl: "/admin/dashboard",
  };
}

export async function logoutAction(): Promise<ActionState> {
  const user = await getCurrentUser();
  if (user && user.sessionId) {
    await prisma.session.update({
      where: { id: user.sessionId },
      data: { revokedAt: new Date() },
    });
  }

  const cookieStore = await cookies();
  cookieStore.delete("session_token");

  return {
    success: true,
    redirectUrl: "/admin/login",
  };
}
