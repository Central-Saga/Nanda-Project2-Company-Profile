@extends('layouts.admin')

@section('title', 'Edit Pengguna: ' . $user->name)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="border-l-2 border-[#10B981] pl-4">
        <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
            MANAJEMEN PENGGUNA
        </span>
        <h1 class="text-2xl font-extrabold text-white mt-1">
            Edit Pengguna: {{ $user->name }}
        </h1>
        <p class="text-xs text-[#A0ADA5] font-mono mt-1">
            Perbarui informasi akun, email login, peran, atau status aktif.
        </p>
    </div>

    <form method="POST" action="{{ route('admin.pengguna.update', $user->id) }}" class="glass-panel rounded-3xl p-6 sm:p-8 border border-white/10 space-y-5">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label for="name" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Nama Lengkap <span class="text-[#34D399]">*</span>
            </label>
            <input type="text"
                   id="name"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   required
                   class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('name') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
            @error('name')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Alamat Email Login <span class="text-[#34D399]">*</span>
            </label>
            <input type="email"
                   id="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   required
                   class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('email') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
            @error('email')
                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                Peran (Role Akses) <span class="text-[#34D399]">*</span>
            </label>
            <select id="role"
                    name="role"
                    required
                    class="w-full px-4 py-2.5 text-sm bg-[#101713] border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin (Kelola Konten &amp; CRM)</option>
                <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor (Kelola Artikel &amp; Galeri)</option>
                <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Super Admin (Hak Akses Penuh)</option>
            </select>
        </div>

        <!-- Password (Optional) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-white/10">
            <div>
                <label for="password" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Password Baru (Kosongkan jika tidak diubah)
                </label>
                <input type="password"
                       id="password"
                       name="password"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('password') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                @error('password')
                    <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                    Konfirmasi Password Baru
                </label>
                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
            </div>
        </div>

        <!-- Status Aktif -->
        <div class="pt-2">
            <label class="flex items-center space-x-2 cursor-pointer font-mono text-xs">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }} class="rounded border-white/20 text-[#10B981] focus:ring-[#10B981]">
                <span class="text-white font-medium">Akun Aktif (Dapat Login)</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-4 border-t border-white/10">
            <a href="{{ route('admin.pengguna.index') }}" class="px-4 py-2 text-xs font-mono text-[#A0ADA5] hover:text-white transition-colors">
                &larr; Batal
            </a>
            <button type="submit" class="btn-emerald px-6 py-2.5 text-xs font-mono font-semibold rounded-xl">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

