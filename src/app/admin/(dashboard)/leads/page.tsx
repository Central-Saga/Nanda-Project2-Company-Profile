import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { EmptyState } from "@/components/admin/EmptyState";
import { LeadStatusSelector } from "./LeadStatusSelector";

export const metadata = {
  title: "Leads & Brief",
};

export default async function LeadsPage() {
  const leads = await prisma.lead.findMany({
    include: {
      brief: true,
      messages: true,
    },
    orderBy: { createdAt: "desc" },
  });

  return (
    <div>
      <PageHeader
        title="Daftar Leads & Brief Proyek"
        description="Semua data kontak dan brief masuk langsung tersimpan di database tanpa melalui WhatsApp."
      />

      {leads.length === 0 ? (
        <EmptyState
          title="Belum ada leads masuk"
          description="Formulir kontak dan konsultasi di website publik akan otomatis masuk dan tercatat di sini."
        />
      ) : (
        <div className="border border-zinc-900 rounded-lg overflow-hidden bg-zinc-950">
          <table className="w-full text-left text-xs font-mono">
            <thead className="bg-zinc-900/60 text-zinc-400 uppercase tracking-wider border-b border-zinc-900">
              <tr>
                <th className="py-3 px-4">Nama Lengkap</th>
                <th className="py-3 px-4">Kontak</th>
                <th className="py-3 px-4">Perusahaan</th>
                <th className="py-3 px-4">Sumber</th>
                <th className="py-3 px-4">Brief / Pesan</th>
                <th className="py-3 px-4">Status Lead</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-zinc-900 text-zinc-300">
              {leads.map((lead) => (
                <tr key={lead.id} className="hover:bg-zinc-900/30 transition">
                  <td className="py-3 px-4 font-medium text-zinc-100 font-sans">
                    {lead.fullName}
                  </td>
                  <td className="py-3 px-4 text-zinc-400">
                    <div>{lead.email}</div>
                    {lead.phone && <div className="text-[11px] text-zinc-500">{lead.phone}</div>}
                  </td>
                  <td className="py-3 px-4 text-zinc-400">
                    {lead.companyName || "-"}
                  </td>
                  <td className="py-3 px-4 uppercase text-[11px] text-zinc-500">
                    {lead.sourceType}
                  </td>
                  <td className="py-3 px-4 text-zinc-300 max-w-xs truncate font-sans">
                    {lead.brief ? (
                      <span className="text-red-400 font-mono text-[11px]">
                        [Brief: {lead.brief.projectType || "Tersedia"}]
                      </span>
                    ) : lead.messages[0] ? (
                      lead.messages[0].message
                    ) : (
                      "-"
                    )}
                  </td>
                  <td className="py-3 px-4">
                    <LeadStatusSelector leadId={lead.id} currentStatus={lead.status} />
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
