"use client";

import { useState } from "react";
import { uploadMediaAction } from "@/app/actions/media";

export function MediaUploader({ onUploaded }: { onUploaded?: (media: any) => void }) {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<string | null>(null);

  async function handleFileChange(e: React.ChangeEvent<HTMLInputElement>) {
    const file = e.target.files?.[0];
    if (!file) return;

    setLoading(true);
    setError(null);
    setSuccess(null);

    const formData = new FormData();
    formData.append("file", file);
    formData.append("folder", "uploads");

    const res = await uploadMediaAction(formData);
    setLoading(false);

    if (!res.success) {
      setError(res.error || "Gagal mengunggah file");
    } else {
      setSuccess(`File "${file.name}" berhasil diunggah.`);
      if (onUploaded) {
        onUploaded(res.data);
      }
    }
  }

  return (
    <div className="p-4 rounded-lg border border-dashed border-zinc-800 bg-zinc-950 text-center space-y-3">
      <div className="text-xs font-mono text-zinc-400">
        Unggah Dokumen / Gambar ke S3-Compatible Storage
      </div>
      <div className="flex flex-col items-center justify-center">
        <label className="cursor-pointer px-4 py-2 bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-xs font-mono text-zinc-200 uppercase tracking-wider rounded transition-colors">
          {loading ? "Sedang Mengunggah..." : "Pilih Berkas"}
          <input
            type="file"
            onChange={handleFileChange}
            disabled={loading}
            className="hidden"
            accept="image/jpeg,image/png,image/webp,image/svg+xml,application/pdf"
          />
        </label>
      </div>
      {error && <div className="text-xs font-mono text-red-500">{error}</div>}
      {success && <div className="text-xs font-mono text-emerald-400">{success}</div>}
      <div className="text-[11px] text-zinc-600 font-mono">
        Maksimal 10MB (JPEG, PNG, WEBP, SVG, PDF)
      </div>
    </div>
  );
}
