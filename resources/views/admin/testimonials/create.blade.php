@extends('layouts.admin')

@section('title', 'Tambah Testimoni')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="border-l-2 border-[#A84E1C] pl-4">
        <h1 class="font-serif text-2xl font-bold text-[#14201C]">
            Tambah Testimoni Klien
        </h1>
        <p class="text-xs text-[#6B6A64] mt-1">
            Tambahkan ulasan klien nyata yang telah bekerja sama dengan {{ config('app.name') }}.
        </p>
    </div>

    <div class="bg-white border border-[#DCD5C8] rounded-[4px] p-6 sm:p-8 shadow-xs">
        <form method="POST" action="/admin/testimoni" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Nama Klien / Tokoh <span class="text-[#A84E1C]">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border @error('name') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none"
                       placeholder="Contoh: I Wayan Sudarta">
                @error('name')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role / Jabatan -->
            <div>
                <label for="role" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Jabatan & Perusahaan <span class="text-[#A84E1C]">*</span>
                </label>
                <input type="text"
                       id="role"
                       name="role"
                       value="{{ old('role') }}"
                       required
                       class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border @error('role') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none"
                       placeholder="Contoh: CEO, Bali Digital Ventures">
                @error('role')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pesan / Kutipan -->
            <div>
                <label for="message" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Isi Kutipan / Ulasan <span class="text-[#A84E1C]">*</span>
                </label>
                <textarea id="message"
                          name="message"
                          rows="4"
                          required
                          class="w-full px-3.5 py-2.5 text-sm bg-white border @error('message') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none leading-relaxed"
                          placeholder="Tuliskan testimoni yang diberikan oleh klien...">{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Rating -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-[#14201C] mb-1.5">
                        Rating (1 - 5 Bintang) <span class="text-[#A84E1C]">*</span>
                    </label>
                    <select id="rating"
                            name="rating"
                            required
                            class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border @error('rating') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none">
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>
                                {{ $i }} Bintang ({{ str_repeat('★', $i) }})
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-[#14201C] mb-1.5">
                        Status Moderasi <span class="text-[#A84E1C]">*</span>
                    </label>
                    <select id="status"
                            name="status"
                            required
                            class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-white border @error('status') border-[#A84E1C] @else border-[#8A867B] @enderror rounded-[4px] text-[#14201C] focus:border-[#A84E1C] focus:ring-1 focus:ring-[#A84E1C] focus:outline-none">
                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Menunggu Moderasi</option>
                        <option value="approved" {{ old('status', 'approved') === 'approved' ? 'selected' : '' }}>Disetujui (Tampil di Publik)</option>
                        <option value="hidden" {{ old('status') === 'hidden' ? 'selected' : '' }}>Disembunyikan</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Foto -->
            <div>
                <label for="photo" class="block text-sm font-medium text-[#14201C] mb-1.5">
                    Foto Klien (Opsional, JPG, PNG, atau WebP, maks 2MB)
                </label>
                <input type="file"
                       id="photo"
                       name="photo"
                       accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-xs text-[#6B6A64] file:mr-4 file:py-2.5 file:px-4 file:rounded-[4px] file:border-0 file:text-xs file:font-semibold file:bg-[#DCD5C8]/50 file:text-[#14201C] hover:file:bg-[#DCD5C8] cursor-pointer">
                @error('photo')
                    <p class="text-xs text-[#A84E1C] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="pt-4 border-t border-[#DCD5C8] flex items-center space-x-4">
                <button type="submit"
                        class="min-h-[44px] px-6 py-2.5 text-sm font-medium text-white bg-[#A84E1C] hover:bg-[#8e4116] rounded-[4px] transition-colors focus-visible:ring-2 focus-visible:ring-[#A84E1C]">
                    Simpan Testimoni
                </button>
                <a href="/admin/testimoni" class="min-h-[44px] inline-flex items-center px-4 py-2 text-sm text-[#6B6A64] hover:text-[#14201C]">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

