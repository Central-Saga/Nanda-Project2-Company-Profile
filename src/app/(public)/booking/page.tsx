import { BookingForm } from "./BookingForm";

export const metadata = {
  title: "Jadwalkan Konsultasi Teknis",
};

export default function BookingPage() {
  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-mono uppercase tracking-widest text-red-500">
          Konsultasi Arsitektur
        </span>
        <h1 className="text-3xl font-bold text-white uppercase">
          Jadwalkan Sesi Konsultasi Sistem
        </h1>
        <p className="text-sm text-zinc-400 font-sans">
          Pilih waktu yang tersedia untuk mendiskusikan rancangan infrastruktur, refactoring kode, atau arsitektur komputasi awan langsung dengan tim arsitek kami.
        </p>
      </div>

      <BookingForm />
    </div>
  );
}
