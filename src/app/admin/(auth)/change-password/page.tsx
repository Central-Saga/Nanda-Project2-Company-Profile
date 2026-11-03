import { ChangePasswordForm } from "./ChangePasswordForm";

export const metadata = {
  title: "Ganti Password",
};

export default function ChangePasswordPage() {
  return (
    <div className="min-h-screen bg-black flex items-center justify-center p-4">
      <div className="w-full max-w-md p-8 bg-zinc-950 border border-zinc-800 rounded-lg">
        <div className="mb-6">
          <div className="inline-block px-2 py-0.5 text-xs font-mono bg-amber-950 text-amber-400 border border-amber-800/60 rounded mb-2">
            KEBIJAKAN KEAMANAN
          </div>
          <h1 className="text-xl font-bold text-zinc-100 tracking-tight">Ganti Password Awal</h1>
          <p className="text-xs text-zinc-400 mt-1">
            Untuk menjaga keamanan sistem, Anda diwajibkan mengganti password sementara sebelum mengakses dashboard.
          </p>
        </div>

        <ChangePasswordForm />
      </div>
    </div>
  );
}
