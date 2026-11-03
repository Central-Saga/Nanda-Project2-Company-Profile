"use client";

import { useTransition } from "react";
import { deleteProjectAction } from "@/app/actions/project";

export function DeleteProjectButton({ id, title }: { id: string; title: string }) {
  const [isPending, startTransition] = useTransition();

  function handleDelete() {
    if (confirm(`Apakah Anda yakin ingin menghapus proyek "${title}"?`)) {
      startTransition(async () => {
        await deleteProjectAction(id);
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
