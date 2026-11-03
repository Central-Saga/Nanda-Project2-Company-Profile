"use client";

import { useTransition } from "react";
import { deleteMediaAction } from "@/app/actions/media";

export function DeleteMediaButton({ id, name }: { id: string; name: string }) {
  const [isPending, startTransition] = useTransition();

  return (
    <button
      disabled={isPending}
      onClick={() => {
        if (confirm(`Yakin ingin menghapus berkas "${name}"?`)) {
          startTransition(async () => {
            await deleteMediaAction(id);
          });
        }
      }}
      className="text-[11px] font-mono text-zinc-500 hover:text-red-400 transition-colors uppercase"
    >
      {isPending ? "Menghapus..." : "Hapus"}
    </button>
  );
}
