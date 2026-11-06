import { prisma } from "@/lib/prisma";
import { ContactForm } from "./ContactForm";

export const metadata = {
  title: "Hubungi Kami",
};

export default async function ContactPage() {
  const company = await prisma.companyProfile.findFirst();
  const brandName = company?.companyName || "PT Rekasaya Digital International";

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 space-y-12">
      <div className="max-w-2xl space-y-3">
        <span className="text-xs font-semibold uppercase tracking-wider text-red-500">
          Saluran Komunikasi
        </span>
        <h1 className="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Hubungi Tim Rekayasa Kami
        </h1>
        <p className="text-sm sm:text-base text-zinc-400 leading-relaxed font-normal">
          Seluruh pesan disimpan langsung di database sistem internal dan direspons secara profesional.
        </p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div className="lg:col-span-2">
          <ContactForm />
        </div>

        <div className="space-y-6 text-xs">
          <div className="p-7 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl space-y-4">
            <div className="text-zinc-200 font-bold uppercase tracking-wider text-xs">
              Informasi Perusahaan
            </div>
            <div className="text-zinc-300 font-medium">
              {brandName}
            </div>
            {company?.address && (
              <div className="text-zinc-400 leading-relaxed">
                {company.address}
              </div>
            )}
            <div className="pt-3 border-t border-white/[0.08] space-y-1.5 text-zinc-400">
              {company?.emailPublic && <div>Email: {company.emailPublic}</div>}
              {company?.phone && <div>Telepon: {company.phone}</div>}
            </div>
          </div>

          <div className="p-7 rounded-2xl bg-white/[0.03] border border-white/[0.08] backdrop-blur-xl space-y-2">
            <div className="text-red-400 font-bold uppercase tracking-wider text-xs">
              Sistem Terintegrasi
            </div>
            <p className="text-zinc-400 leading-relaxed text-xs">
              Platform kami merekam seluruh kebutuhan teknis langsung ke basis data terpusat demi kepastian tindak lanjut dan audit berkala.
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}
