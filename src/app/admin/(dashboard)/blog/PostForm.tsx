"use client";

import { useActionState, useEffect } from "react";
import { createPostAction, updatePostAction } from "@/app/actions/post";
import { FormField } from "@/components/admin/FormField";
import { SubmitButton } from "@/components/admin/SubmitButton";
import { useRouter } from "next/navigation";
import Link from "next/link";

interface PostFormProps {
  categories: { id: string; name: string }[];
  initialData?: {
    id: string;
    slug: string;
    categoryId?: string | null;
    status: "draft" | "published";
    isFeatured: boolean;
    title: string;
    excerpt?: string | null;
    content: string;
  };
}

export function PostForm({ categories, initialData }: PostFormProps) {
  const isEditing = Boolean(initialData);
  const action = isEditing ? updatePostAction : createPostAction;
  const [state, formAction, isPending] = useActionState(action, null);
  const router = useRouter();

  useEffect(() => {
    if (state?.success && state?.redirectUrl) {
      router.push(state.redirectUrl);
    }
  }, [state, router]);

  return (
    <form action={formAction} className="space-y-6 max-w-3xl">
      {isEditing && <input type="hidden" name="id" value={initialData!.id} />}

      {state?.message && !state?.success && (
        <div className="p-3 bg-red-950/50 border border-red-700/50 text-red-300 text-sm rounded font-mono">
          {state.message}
        </div>
      )}

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Konten Artikel
        </h2>

        <FormField
          label="Judul Artikel"
          name="title"
          required
          defaultValue={initialData?.title}
          errors={state?.errors?.title}
        />

        <FormField
          label="Slug (URL)"
          name="slug"
          required
          placeholder="arsitektur-event-driven-microservices"
          defaultValue={initialData?.slug}
          errors={state?.errors?.slug}
        />

        <FormField
          label="Kutipan / Excerpt Singkat"
          name="excerpt"
          multiline
          rows={2}
          defaultValue={initialData?.excerpt || ""}
          errors={state?.errors?.excerpt}
        />

        <FormField
          label="Isi Konten Artikel (Markdown)"
          name="content"
          required
          multiline
          rows={12}
          placeholder="# Pengantar..."
          defaultValue={initialData?.content}
          errors={state?.errors?.content}
        />
      </div>

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-sm font-bold font-mono uppercase tracking-wider text-zinc-300">
          Kategori & Status Publikasi
        </h2>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
              Kategori
            </label>
            <select
              name="categoryId"
              defaultValue={initialData?.categoryId || ""}
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600"
            >
              <option value="">-- Tanpa Kategori --</option>
              {categories.map((c) => (
                <option key={c.id} value={c.id}>
                  {c.name}
                </option>
              ))}
            </select>
          </div>

          <div>
            <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
              Status Publikasi
            </label>
            <select
              name="status"
              defaultValue={initialData?.status || "draft"}
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600"
            >
              <option value="draft">Draft (Konsep)</option>
              <option value="published">Published (Tayang)</option>
            </select>
          </div>
        </div>

        <div className="pt-2">
          <label className="flex items-center gap-2 cursor-pointer">
            <input
              type="checkbox"
              name="isFeatured"
              defaultChecked={initialData ? initialData.isFeatured : false}
              className="w-4 h-4 rounded bg-zinc-900 border-zinc-700 text-red-600 focus:ring-red-600"
            />
            <span className="text-xs font-mono uppercase text-zinc-300">
              Sematkan sebagai Artikel Unggulan
            </span>
          </label>
        </div>
      </div>

      <div className="flex items-center gap-3">
        <SubmitButton
          pending={isPending}
          label={isEditing ? "Perbarui Artikel" : "Terbitkan Artikel"}
        />
        <Link
          href="/admin/blog"
          className="px-4 py-2 text-sm text-zinc-400 hover:text-zinc-200 transition"
        >
          Batal
        </Link>
      </div>
    </form>
  );
}
