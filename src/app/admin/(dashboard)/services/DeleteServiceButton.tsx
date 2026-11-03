"use client";

import { useTransition } from "react";
import { deleteServiceAction } from "@/app/actions/service";

export function DeleteServiceButton({ id, name }: { id: string; name: string }) {
  const [isPending, startTransition] = useTransition();

  function handleDelete() {
    if (confirm(`Apakah Anda yakin ingin menghapus layanan "${name}"?`)) {
      startTransition(async () => {
        await deleteServiceAction(id);
      });
    }
  }

  return (
    <button
      onClick={handleDelete}
      disabled={isPending}
      className="text-xs font-mono text-zinc-500 hover:text-red-400 transition disabled:opacity-50"
    >
      {isPending ? "Menghapus..." : "Hapus"}
    </button>
  );
}
