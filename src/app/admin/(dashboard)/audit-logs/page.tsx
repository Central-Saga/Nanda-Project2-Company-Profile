import { prisma } from "@/lib/prisma";
import { PageHeader } from "@/components/admin/PageHeader";
import { EmptyState } from "@/components/admin/EmptyState";

export default async function AuditLogsPage() {
  const logs = await prisma.auditLog.findMany({
    orderBy: { createdAt: "desc" },
    take: 100,
    include: { user: true },
  });

  return (
    <div className="space-y-6">
      <PageHeader
        title="Log Audit & Rekam Jejak Sistem"
        description="Transparansi dan ketertelusuran mutlak terhadap seluruh aktivitas perubahan data internal."
      />

      <div className="bg-zinc-950 border border-zinc-900 rounded-lg overflow-hidden">
        {logs.length === 0 ? (
          <EmptyState
            title="Belum ada catatan log"
            description="Seluruh perubahan entitas pada database akan otomatis tercatat di sini."
          />
        ) : (
          <div className="overflow-x-auto">
            <table className="w-full text-left text-xs font-mono">
              <thead className="bg-zinc-900/50 text-zinc-400 border-b border-zinc-800 uppercase text-[11px] tracking-wider">
                <tr>
                  <th className="py-3 px-4">Waktu</th>
                  <th className="py-3 px-4">Pelaku</th>
                  <th className="py-3 px-4">Aksi</th>
                  <th className="py-3 px-4">Entitas</th>
                  <th className="py-3 px-4">ID Entitas</th>
                  <th className="py-3 px-4">Data</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-zinc-900 text-zinc-300">
                {logs.map((log) => (
                  <tr key={log.id} className="hover:bg-zinc-900/30">
                    <td className="py-3 px-4 text-zinc-500 whitespace-nowrap">
                      {new Date(log.createdAt).toLocaleString("id-ID")}
                    </td>
                    <td className="py-3 px-4">
                      {log.user?.fullName || log.user?.email || "Sistem"}
                    </td>
                    <td className="py-3 px-4">
                      <span className="px-2 py-0.5 rounded bg-zinc-900 border border-zinc-800 text-[10px] uppercase font-bold text-red-500">
                        {log.action}
                      </span>
                    </td>
                    <td className="py-3 px-4 text-zinc-200">
                      {log.entityType}
                    </td>
                    <td className="py-3 px-4 text-zinc-500 truncate max-w-[120px]">
                      {log.entityId}
                    </td>
                    <td className="py-3 px-4 max-w-xs truncate text-[11px] text-zinc-400 font-mono">
                      {log.newValues ? JSON.stringify(log.newValues) : log.oldValues ? JSON.stringify(log.oldValues) : "-"}
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
