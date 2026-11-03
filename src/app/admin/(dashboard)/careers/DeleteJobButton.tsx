"use client";

import { useTransition } from "react";
import { deleteJobAction } from "@/app/actions/job";

export function DeleteJobButton({ id, title }: { id: string; title: string }) {
  const [isPending, startTransition] = useTransition();

  function handleDelete() {
    if (confirm(`Apakah Anda yakin ingin menghapus lowongan "${title}"?`)) {
      startTransition(async () => {
        await deleteJobAction(id);
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
