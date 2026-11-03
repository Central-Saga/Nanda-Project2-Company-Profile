import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { EmptyState } from "@/components/admin/EmptyState";
import { DeleteServiceButton } from "./DeleteServiceButton";
import Link from "next/link";

export const metadata = {
  title: "Layanan",
};

export default async function ServicesPage() {
  const services = await prisma.service.findMany({
    where: { deletedAt: null },
    include: {
      translations: {
        where: { locale: "id" },
      },
    },
    orderBy: { sortOrder: "asc" },
  });

  return (
    <div>
      <PageHeader
        title="Daftar Layanan"
        description="Kelola portofolio kapabilitas & solusi teknologi yang ditawarkan kepada klien."
        actions={
          <Link
            href="/admin/services/new"
            className="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-mono uppercase tracking-wider transition"
          >
            + Tambah Layanan
          </Link>
        }
      />

      {services.length === 0 ? (
        <EmptyState
          title="Belum ada data layanan"
          description="Tambahkan layanan pertama untuk mulai menampilkan ke website publik."
          actionLabel="+ Tambah Layanan Pertama"
          actionHref="/admin/services/new"
        />
      ) : (
        <div className="border border-zinc-900 rounded-lg overflow-hidden bg-zinc-950">
          <table className="w-full text-left text-xs font-mono">
            <thead className="bg-zinc-900/60 text-zinc-400 uppercase tracking-wider border-b border-zinc-900">
              <tr>
                <th className="py-3 px-4">Nama Layanan</th>
                <th className="py-3 px-4">Slug</th>
                <th className="py-3 px-4">Urutan</th>
                <th className="py-3 px-4">Status</th>
                <th className="py-3 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-zinc-900 text-zinc-300">
              {services.map((item) => {
                const trans = item.translations[0];
                return (
                  <tr key={item.id} className="hover:bg-zinc-900/30 transition">
                    <td className="py-3 px-4 font-medium text-zinc-100 font-sans">
                      {trans?.name || "(Tanpa Judul)"}
                    </td>
                    <td className="py-3 px-4 text-zinc-400">{item.slug}</td>
                    <td className="py-3 px-4">{item.sortOrder}</td>
                    <td className="py-3 px-4">
                      {item.isPublished ? (
                        <span className="px-2 py-0.5 rounded text-[10px] bg-green-950 text-green-400 border border-green-800">
                          PUBLISHED
                        </span>
                      ) : (
                        <span className="px-2 py-0.5 rounded text-[10px] bg-zinc-900 text-zinc-500 border border-zinc-800">
                          DRAFT
                        </span>
                      )}
                    </td>
                    <td className="py-3 px-4 text-right space-x-3">
                      <Link
                        href={`/admin/services/${item.id}/edit`}
                        className="text-zinc-400 hover:text-zinc-100 transition"
                      >
                        Edit
                      </Link>
                      <DeleteServiceButton id={item.id} name={trans?.name || item.slug} />
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
