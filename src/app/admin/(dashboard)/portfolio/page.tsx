import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { EmptyState } from "@/components/admin/EmptyState";
import { DeleteProjectButton } from "./DeleteProjectButton";
import Link from "next/link";

export const metadata = {
  title: "Portofolio",
};

export default async function PortfolioPage() {
  const projects = await prisma.project.findMany({
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
        title="Daftar Portofolio / Studi Kasus"
        description="Kelola rekam jejak proyek software, tantangan, dan solusi teknologi yang telah dibangun."
        actions={
          <Link
            href="/admin/portfolio/new"
            className="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-mono uppercase tracking-wider transition"
          >
            + Tambah Proyek
          </Link>
        }
      />

      {projects.length === 0 ? (
        <EmptyState
          title="Belum ada data proyek"
          description="Tambahkan studi kasus pertama untuk membangun kredibilitas teknis software house."
          actionLabel="+ Tambah Proyek Pertama"
          actionHref="/admin/portfolio/new"
        />
      ) : (
        <div className="border border-zinc-900 rounded-lg overflow-hidden bg-zinc-950">
          <table className="w-full text-left text-xs font-mono">
            <thead className="bg-zinc-900/60 text-zinc-400 uppercase tracking-wider border-b border-zinc-900">
              <tr>
                <th className="py-3 px-4">Judul Proyek</th>
                <th className="py-3 px-4">Slug</th>
                <th className="py-3 px-4">Unggulan</th>
                <th className="py-3 px-4">Status</th>
                <th className="py-3 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-zinc-900 text-zinc-300">
              {projects.map((item) => {
                const trans = item.translations[0];
                return (
                  <tr key={item.id} className="hover:bg-zinc-900/30 transition">
                    <td className="py-3 px-4 font-medium text-zinc-100 font-sans">
                      {trans?.title || "(Tanpa Judul)"}
                    </td>
                    <td className="py-3 px-4 text-zinc-400">{item.slug}</td>
                    <td className="py-3 px-4">
                      {item.isFeatured ? (
                        <span className="text-amber-400">★ Ya</span>
                      ) : (
                        <span className="text-zinc-600">-</span>
                      )}
                    </td>
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
                        href={`/admin/portfolio/${item.id}/edit`}
                        className="text-zinc-400 hover:text-zinc-100 transition"
                      >
                        Edit
                      </Link>
                      <DeleteProjectButton id={item.id} title={trans?.title || item.slug} />
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
