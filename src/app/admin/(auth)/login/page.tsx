import { LoginForm } from "./LoginForm";

export const metadata = {
  title: "Login Admin",
};

export default function LoginPage() {
  return (
    <div className="min-h-screen bg-black flex items-center justify-center p-4">
      <div className="w-full max-w-md p-8 bg-zinc-950 border border-zinc-800 rounded-lg">
        <div className="mb-6">
          <div className="inline-block px-2 py-0.5 text-xs font-mono bg-red-950 text-red-400 border border-red-800/60 rounded mb-2">
            ADMIN ACCESS
          </div>
          <h1 className="text-xl font-bold text-zinc-100 tracking-tight">Portal Manajemen</h1>
          <p className="text-xs text-zinc-400 mt-1">
            Masuk dengan kredensial sistem untuk mengelola platform.
          </p>
        </div>

        <LoginForm />
      </div>
    </div>
  );
}
