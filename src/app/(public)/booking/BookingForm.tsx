"use client";

import { useActionState } from "react";
import { submitBookingAction } from "@/app/actions/public";
import { SubmitButton } from "@/components/admin/SubmitButton";

export function BookingForm() {
  const [state, formAction, isPending] = useActionState(submitBookingAction, null);

  const todayStr = new Date().toISOString().split("T")[0];

  return (
    <form action={formAction} className="space-y-6 max-w-2xl">
      {state?.message && (
        <div
          className={`p-4 rounded text-xs font-sans border ${
            state.success
              ? "bg-green-950/40 border-green-800 text-green-300"
              : "bg-red-950/40 border-red-800 text-red-300"
          }`}
        >
          {state.message}
        </div>
      )}

      <input
        type="text"
        name="websiteUrl"
        style={{ display: "none" }}
        tabIndex={-1}
        autoComplete="off"
      />

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-xs font-bold font-sans uppercase tracking-wider text-zinc-300">
          1. Data Pemohon
        </h2>

        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label className="block text-xs font-sans uppercase tracking-wider text-zinc-400 mb-1">
              Nama Lengkap <span className="text-red-500">*</span>
            </label>
            <input
              type="text"
              name="fullName"
              required
              placeholder="Hendro Wibowo"
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
            />
            {state?.errors?.fullName && (
              <p className="text-xs text-red-400 mt-1">{state.errors.fullName[0]}</p>
            )}
          </div>

          <div>
            <label className="block text-xs font-sans uppercase tracking-wider text-zinc-400 mb-1">
              Email Kerja <span className="text-red-500">*</span>
            </label>
            <input
              type="email"
              name="email"
              required
              placeholder="hendro@fintech.co.id"
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
            />
            {state?.errors?.email && (
              <p className="text-xs text-red-400 mt-1">{state.errors.email[0]}</p>
            )}
          </div>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label className="block text-xs font-sans uppercase tracking-wider text-zinc-400 mb-1">
              Nomor Telepon
            </label>
            <input
              type="tel"
              name="phone"
              placeholder="08123456789"
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
            />
          </div>

          <div>
            <label className="block text-xs font-sans uppercase tracking-wider text-zinc-400 mb-1">
              Nama Organisasi / Perusahaan
            </label>
            <input
              type="text"
              name="companyName"
              placeholder="PT Sistem Keuangan Indonesia"
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
            />
          </div>
        </div>
      </div>

      <div className="p-5 bg-zinc-950 border border-zinc-900 rounded-lg space-y-4">
        <h2 className="text-xs font-bold font-sans uppercase tracking-wider text-zinc-300">
          2. Waktu & Topik Konsultasi
        </h2>

        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label className="block text-xs font-sans uppercase tracking-wider text-zinc-400 mb-1">
              Pilihan Tanggal <span className="text-red-500">*</span>
            </label>
            <input
              type="date"
              name="preferredDate"
              required
              min={todayStr}
              defaultValue={todayStr}
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans text-xs"
            />
            {state?.errors?.preferredDate && (
              <p className="text-xs text-red-400 mt-1">{state.errors.preferredDate[0]}</p>
            )}
          </div>

          <div>
            <label className="block text-xs font-sans uppercase tracking-wider text-zinc-400 mb-1">
              Slot Waktu (WIB) <span className="text-red-500">*</span>
            </label>
            <select
              name="preferredTimeSlot"
              required
              className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans text-xs"
            >
              <option value="09:00 - 10:00 WIB">09:00 - 10:00 WIB</option>
              <option value="10:30 - 11:30 WIB">10:30 - 11:30 WIB</option>
              <option value="13:30 - 14:30 WIB">13:30 - 14:30 WIB</option>
              <option value="15:00 - 16:00 WIB">15:00 - 16:00 WIB</option>
            </select>
          </div>
        </div>

        <div>
          <label className="block text-xs font-sans uppercase tracking-wider text-zinc-400 mb-1">
            Topik Masalah atau Diskusi Arsitektur <span className="text-red-500">*</span>
          </label>
          <textarea
            name="topic"
            required
            rows={3}
            placeholder="Jelaskan kendala teknis atau arsitektur yang ingin dibahas dalam sesi konsultasi..."
            className="w-full px-3 py-2 bg-zinc-900 border border-zinc-800 text-zinc-100 rounded text-sm focus:outline-none focus:border-red-600 font-sans"
          />
          {state?.errors?.topic && (
            <p className="text-xs text-red-400 mt-1">{state.errors.topic[0]}</p>
          )}
        </div>
      </div>

      <div>
        <label className="flex items-start gap-2 cursor-pointer">
          <input
            type="checkbox"
            name="consentPrivacy"
            required
            className="mt-1 rounded bg-zinc-900 border-zinc-800 text-red-600 focus:ring-0"
          />
          <span className="text-xs text-zinc-400 font-sans">
            Saya menyetujui jadwal konsultasi ini dicatat dalam sistem dan dihubungi oleh arsitek teknis terkait.
          </span>
        </label>
        {state?.errors?.consentPrivacy && (
          <p className="text-xs text-red-400 mt-1">{state.errors.consentPrivacy[0]}</p>
        )}
      </div>

      <div>
        <SubmitButton pending={isPending} label="Jadwalkan Sesi Konsultasi" />
      </div>
    </form>
  );
}
