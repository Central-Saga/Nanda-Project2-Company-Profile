@extends('layouts.admin')

@section('title', 'Ganti Password')

@section('content')
<div class="max-w-xl space-y-6">
    <div class="border-l-2 border-[#A84E1C] pl-4">
        <h1 class="font-serif text-2xl font-bold text-[#14201C]">
            Ganti Password Akun
        </h1>
        <p class="text-xs text-[#6B6A64] mt-1">
            Pastikan akun Anda menggunakan kata sandi yang kuat dan aman.
        </p>
    </div>

    <div class="bg-white border border-[#DCD5C8] rounded-[4px] p-6 sm:p-8 shadow-xs">
        <form method="POST" action="/admin/password" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Password Saat Ini -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Password Saat Ini <span class="text-[#A84E1C]">*</span>
                </label>
                <input type="password"
                       id="current_password"
                       name="current_password"
                       required
                       autocomplete="current-password"
                       class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border @error('current_password') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none"
                       placeholder="••••••••">
                @error('current_password')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Baru -->
            <div>
                <label for="password" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Password Baru (Minimal 8 karakter) <span class="text-[#A84E1C]">*</span>
                </label>
                <input type="password"
                       id="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border @error('password') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none"
                       placeholder="••••••••">
                @error('password')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password Baru -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Ulangi Password Baru <span class="text-[#A84E1C]">*</span>
                </label>
                <input type="password"
                       id="password_confirmation"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border border-[#8A867B] rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none"
                       placeholder="••••••••">
            </div>

            <!-- Submit -->
            <div class="pt-4 border-t border-[#DCD5C8]">
                <button type="submit"
                        class="min-h-[44px] px-6 py-2.5 text-sm font-medium text-white bg-[#A84E1C] hover:bg-[#8e4116] rounded-[4px] transition-colors focus-visible:ring-2 focus-visible:ring-[#A84E1C]">
                    Perbarui Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

