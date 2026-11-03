import { prisma } from "@/lib/prisma";
import { ContactForm } from "./ContactForm";

export const metadata = {
  title: "Hubungi Kami",
};

export default async function ContactPage() {
  const company = await prisma.companyProfile.findFirst();

  const brandName = company?.companyName || "SOFTWARE HOUSE";

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-mono uppercase tracking-widest text-red-500">
          Saluran Komunikasi
        </span>
        <h1 className="text-3xl font-bold text-white uppercase">
          Hubungi Tim Rekayasa Kami
        </h1>
        <p className="text-sm text-zinc-400 font-sans">
          Seluruh pesan disimpan langsung di database sistem internal dan direspons secara profesional.
        </p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div className="lg:col-span-2">
          <ContactForm />
        </div>

        <div className="space-y-6 text-xs font-mono">
          <div className="p-5 rounded-lg bg-zinc-950 border border-zinc-900 space-y-3">
            <div className="text-zinc-200 font-bold uppercase tracking-wider">
              Informasi Perusahaan
            </div>
            <div className="text-zinc-400 font-sans leading-relaxed">
              {brandName}
            </div>
            {company?.address && (
              <div className="text-zinc-500 font-sans">
                {company.address}
              </div>
            )}
            <div className="pt-2 border-t border-zinc-900 space-y-1 text-zinc-400">
              {company?.emailPublic && <div>Email: {company.emailPublic}</div>}
              {company?.phone && <div>Telepon: {company.phone}</div>}
            </div>
          </div>

          <div className="p-5 rounded-lg bg-zinc-950 border border-zinc-900 space-y-2">
            <div className="text-red-400 font-bold uppercase tracking-wider">
              Tanpa Perantara WhatsApp
            </div>
            <p className="text-zinc-500 font-sans leading-relaxed text-[11px]">
              Platform kami tidak menggunakan tombol WhatsApp mengambang demi keteraturan rekam jejak kebutuhan teknis, kerahasiaan brief, dan audit internal.
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}
