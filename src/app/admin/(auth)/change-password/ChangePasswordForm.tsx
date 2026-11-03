"use client";

import { useActionState } from "react";
import { changePasswordAction } from "@/app/actions/auth";
import { useRouter } from "next/navigation";
import { useEffect } from "react";

export function ChangePasswordForm() {
  const [state, formAction, isPending] = useActionState(changePasswordAction, null);
  const router = useRouter();

  useEffect(() => {
    if (state?.success && state?.redirectUrl) {
      router.push(state.redirectUrl);
    }
  }, [state, router]);

  return (
    <form action={formAction} className="space-y-4">
      {state?.message && !state?.success && (
        <div className="p-3 bg-red-950/50 border border-red-700/50 text-red-300 text-sm rounded">
          {state.message}
        </div>
      )}

      {state?.success && (
        <div className="p-3 bg-green-950/50 border border-green-700/50 text-green-300 text-sm rounded">
          Password berhasil diperbarui. Mengalihkan...
        </div>
      )}

      <div>
        <label
          className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1"
          htmlFor="currentPassword"
        >
          Password Saat Ini
        </label>
        <input
          id="currentPassword"
          name="currentPassword"
          type="password"
          autoComplete="current-password"
          required
          className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 font-sans text-sm"
        />
        {state?.errors?.currentPassword && (
          <p className="mt-1 text-xs text-red-400">{state.errors.currentPassword[0]}</p>
        )}
      </div>

      <div>
        <label
          className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1"
          htmlFor="newPassword"
        >
          Password Baru
        </label>
        <input
          id="newPassword"
          name="newPassword"
          type="password"
          autoComplete="new-password"
          required
          className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 font-sans text-sm"
          placeholder="Min. 8 karakter (besar, kecil, angka)"
        />
        {state?.errors?.newPassword && (
          <p className="mt-1 text-xs text-red-400">{state.errors.newPassword[0]}</p>
        )}
      </div>

      <div>
        <label
          className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1"
          htmlFor="confirmPassword"
        >
          Konfirmasi Password Baru
        </label>
        <input
          id="confirmPassword"
          name="confirmPassword"
          type="password"
          autoComplete="new-password"
          required
          className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 font-sans text-sm"
        />
        {state?.errors?.confirmPassword && (
          <p className="mt-1 text-xs text-red-400">{state.errors.confirmPassword[0]}</p>
        )}
      </div>

      <button
        type="submit"
        disabled={isPending}
        className="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 disabled:opacity-50 text-white font-medium text-sm rounded transition focus:outline-none focus:ring-2 focus:ring-red-500"
      >
        {isPending ? "Menyimpan..." : "Perbarui Password"}
      </button>
    </form>
  );
}
