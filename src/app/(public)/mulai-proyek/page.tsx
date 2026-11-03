import { BriefForm } from "./BriefForm";

export const metadata = {
  title: "Mulai Proyek - Kirim Brief Teknis",
};

export default function StartProjectPage() {
  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-mono uppercase tracking-widest text-red-500">
          Inisiasi Rekayasa
        </span>
        <h1 className="text-3xl font-bold text-white uppercase">
          Kirimkan Brief Kebutuhan Proyek
        </h1>
        <p className="text-sm text-zinc-400 font-sans">
          Berikan gambaran arsitektur atau aplikasi yang ingin Anda bangun. Tim Solution Architect kami akan mengkaji kelayakan teknis dan mempersiapkan rancangan implementasi.
        </p>
      </div>

      <BriefForm />
    </div>
  );
}
