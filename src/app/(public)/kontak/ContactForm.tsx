"use client";

import { useActionState } from "react";
import { submitContactAction } from "@/app/actions/public";
import { SubmitButton } from "@/components/admin/SubmitButton";

export function ContactForm() {
  const [state, formAction, isPending] = useActionState(submitContactAction, null);

  return (
    <form action={formAction} className="space-y-4 max-w-xl">
      {state?.message && (
        <div
          className={`p-4 rounded text-xs font-mono border ${
            state.success
              ? "bg-green-950/40 border-green-800 text-green-300"
              : "bg-red-950/40 border-red-800 text-red-300"
          }`}
        >
          {state.message}
        </div>
      )}

      {/* Honeypot field (hidden from real users) */}
      <input
        type="text"
        name="websiteUrl"
        style={{ display: "none" }}
        tabIndex={-1}
        autoComplete="off"
      />

      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
            Nama Lengkap <span className="text-red-500">*</span>
          </label>
          <input
            type="text"
            name="fullName"
            required
            placeholder="Irwan Setiawan"
            className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
          />
          {state?.errors?.fullName && (
            <p className="text-xs text-red-400 mt-1">{state.errors.fullName[0]}</p>
          )}
        </div>

        <div>
          <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
            Email Perusahaan <span className="text-red-500">*</span>
          </label>
          <input
            type="email"
            name="email"
            required
            placeholder="irwan@perusahaan.co.id"
            className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
          />
          {state?.errors?.email && (
            <p className="text-xs text-red-400 mt-1">{state.errors.email[0]}</p>
          )}
        </div>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
            Nomor Telepon
          </label>
          <input
            type="tel"
            name="phone"
            placeholder="081234567890"
            className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
          />
          {state?.errors?.phone && (
            <p className="text-xs text-red-400 mt-1">{state.errors.phone[0]}</p>
          )}
        </div>

        <div>
          <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
            Nama Perusahaan
          </label>
          <input
            type="text"
            name="companyName"
            placeholder="PT Maju Bangsa"
            className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
          />
          {state?.errors?.companyName && (
            <p className="text-xs text-red-400 mt-1">{state.errors.companyName[0]}</p>
          )}
        </div>
      </div>

      <div>
        <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
          Subjek Pesan <span className="text-red-500">*</span>
        </label>
        <input
          type="text"
          name="subject"
          required
          placeholder="Pertanyaan Implementasi Cloud Native"
          className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
        />
        {state?.errors?.subject && (
          <p className="text-xs text-red-400 mt-1">{state.errors.subject[0]}</p>
        )}
      </div>

      <div>
        <label className="block text-xs font-mono uppercase tracking-wider text-zinc-400 mb-1">
          Pesan <span className="text-red-500">*</span>
        </label>
        <textarea
          name="message"
          required
          rows={4}
          placeholder="Tuliskan pertanyaan atau deskripsi kebutuhan Anda di sini..."
          className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
        />
        {state?.errors?.message && (
          <p className="text-xs text-red-400 mt-1">{state.errors.message[0]}</p>
        )}
      </div>

      <div className="pt-2">
        <label className="flex items-start gap-2 cursor-pointer">
          <input
            type="checkbox"
            name="consentPrivacy"
            required
            className="mt-1 rounded bg-zinc-900 border-zinc-800 text-red-600 focus:ring-0"
          />
          <span className="text-xs text-zinc-400 font-sans">
            Saya menyetujui bahwa data kontak ini disimpan di database internal untuk keperluan komunikasi teknis dan profesional.
          </span>
        </label>
        {state?.errors?.consentPrivacy && (
          <p className="text-xs text-red-400 mt-1">{state.errors.consentPrivacy[0]}</p>
        )}
      </div>

      <div className="pt-2">
        <SubmitButton pending={isPending} label="Kirim Pesan Kontak" />
      </div>
    </form>
  );
}
