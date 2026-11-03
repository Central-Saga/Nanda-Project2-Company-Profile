"use client";

import { useTransition } from "react";
import { deletePostAction } from "@/app/actions/post";

export function DeletePostButton({ id, title }: { id: string; title: string }) {
  const [isPending, startTransition] = useTransition();

  function handleDelete() {
    if (confirm(`Apakah Anda yakin ingin menghapus artikel "${title}"?`)) {
      startTransition(async () => {
        await deletePostAction(id);
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
