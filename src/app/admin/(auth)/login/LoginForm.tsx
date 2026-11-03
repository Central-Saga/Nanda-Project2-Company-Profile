"use client";

import { useActionState } from "react";
import { loginAction } from "@/app/actions/auth";
import { useRouter } from "next/navigation";
import { useEffect } from "react";

export function LoginForm() {
  const [state, formAction, isPending] = useActionState(loginAction, null);
  const router = useRouter();

  useEffect(() => {
    if (state?.success && state?.redirectUrl) {
      router.push(state.redirectUrl);
    }
  }, [state, router]);

  return (
    <form action={formAction} className="space-y-4">
      {state?.message && (
        <div className="p-3 bg-red-950/50 border border-red-700/50 text-red-300 text-sm rounded">
          {state.message}
        </div>
      )}

      <div>
        <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1" htmlFor="email">
          Email
        </label>
        <input
          id="email"
          name="email"
          type="email"
          autoComplete="email"
          required
          className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 font-sans text-sm"
          placeholder="admin@example.com"
        />
        {state?.errors?.email && (
          <p className="mt-1 text-xs text-red-400">{state.errors.email[0]}</p>
        )}
      </div>

      <div>
        <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1" htmlFor="password">
          Password
        </label>
        <input
          id="password"
          name="password"
          type="password"
          autoComplete="current-password"
          required
          className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 font-sans text-sm"
          placeholder="••••••••"
        />
        {state?.errors?.password && (
          <p className="mt-1 text-xs text-red-400">{state.errors.password[0]}</p>
        )}
      </div>

      <button
        type="submit"
        disabled={isPending}
        className="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 disabled:opacity-50 text-white font-medium text-sm rounded transition focus:outline-none focus:ring-2 focus:ring-red-500"
      >
        {isPending ? "Memproses..." : "Masuk"}
      </button>
    </form>
  );
}
