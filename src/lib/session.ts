import { SignJWT, jwtVerify } from "jose";
import crypto from "crypto";

const SECRET_KEY = new TextEncoder().encode(
  process.env.AUTH_SECRET || "default_auth_secret_minimum_32_characters_long_12345"
);

export interface SessionPayload {
  userId: string;
  role: string;
  sessionId: string;
  mustChangePassword?: boolean;
}

export function hashToken(token: string): string {
  return crypto.createHash("sha256").update(token).digest("hex");
}

export async function createSessionToken(payload: SessionPayload): Promise<string> {
  return new SignJWT({ ...payload })
    .setProtectedHeader({ alg: "HS256" })
    .setIssuedAt()
    .setExpirationTime("24h")
    .sign(SECRET_KEY);
}

export async function verifySessionToken(token: string): Promise<SessionPayload | null> {
  try {
    const { payload } = await jwtVerify(token, SECRET_KEY, {
      algorithms: ["HS256"],
    });
    return payload as unknown as SessionPayload;
  } catch {
    return null;
  }
}
