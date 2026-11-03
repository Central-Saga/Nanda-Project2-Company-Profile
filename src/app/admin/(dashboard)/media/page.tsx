import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { EmptyState } from "@/components/admin/EmptyState";
import { MediaUploader } from "./MediaUploader";
import { DeleteMediaButton } from "./DeleteMediaButton";

export default async function MediaPage() {
  const mediaList = await prisma.mediaFile.findMany({
    where: { deletedAt: null },
    orderBy: { createdAt: "desc" },
    take: 50,
  });

  return (
    <div className="space-y-6">
      <PageHeader
        title="Pustaka Media & Penyimpanan S3"
        description="Kelola berkas aset gambar, dokumen, dan logo yang tersimpan pada objek penyimpanan S3-compatible."
      />

      <MediaUploader />

      <div className="bg-zinc-950 border border-zinc-900 rounded-lg overflow-hidden">
        {mediaList.length === 0 ? (
          <EmptyState
            title="Belum ada berkas media"
            description="Unggah berkas gambar atau dokumen untuk mulai menggunakan penyimpanan S3."
          />
        ) : (
          <div className="overflow-x-auto">
            <table className="w-full text-left text-xs font-mono">
              <thead className="bg-zinc-900/50 text-zinc-400 border-b border-zinc-800 uppercase text-[11px] tracking-wider">
                <tr>
                  <th className="py-3 px-4">Nama Berkas</th>
                  <th className="py-3 px-4">Tipe & Ukuran</th>
                  <th className="py-3 px-4">Kunci Storage</th>
                  <th className="py-3 px-4">Tautan</th>
                  <th className="py-3 px-4 text-right">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-zinc-900 text-zinc-300">
                {mediaList.map((item) => (
                  <tr key={item.id} className="hover:bg-zinc-900/30">
                    <td className="py-3 px-4">
                      <div className="font-sans font-medium text-zinc-200">
                        {item.originalName}
                      </div>
                      <div className="text-[10px] text-zinc-500">
                        ID: {item.id.slice(0, 8)}...
                      </div>
                    </td>
                    <td className="py-3 px-4">
                      <div>{item.mimeType}</div>
                      <div className="text-zinc-500">
                        {(item.sizeBytes / 1024).toFixed(1)} KB
                      </div>
                    </td>
                    <td className="py-3 px-4 text-zinc-400 truncate max-w-xs">
                      {item.storageKey}
                    </td>
                    <td className="py-3 px-4">
                      <a
                        href={item.url}
                        target="_blank"
                        rel="noreferrer"
                        className="text-red-500 hover:underline"
                      >
                        Buka URL
                      </a>
                    </td>
                    <td className="py-3 px-4 text-right">
                      <DeleteMediaButton id={item.id} name={item.originalName} />
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>
    </div>
  );
}
