@extends('layouts.admin')

@section('title', 'Edit Profil Usaha & Pengaturan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="border-l-2 border-[#10B981] pl-4">
        <span class="text-[11px] font-mono text-[#34D399] tracking-wider uppercase block">
            PENGATURAN PERUSAHAAN
        </span>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">
            Profil Usaha &amp; Konfigurasi SEO
        </h1>
        <p class="text-xs sm:text-sm text-[#A0ADA5] mt-1 font-mono">
            Kelola identitas resmi, narasi hero, visi misi, WhatsApp template, dan tautan sosial.
        </p>
    </div>

    <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-white/10 shadow-xl">
        <form method="POST" action="/admin/profil" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Identitas Utama -->
            <div class="border-b border-white/10 pb-6 space-y-5">
                <h2 class="text-xs font-mono font-bold uppercase tracking-wider text-[#34D399]">
                    1. Identitas Brand &amp; Legal
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="company_name" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Nama Perusahaan Legal <span class="text-[#34D399]">*</span>
                        </label>
                        <input type="text"
                               id="company_name"
                               name="company_name"
                               value="{{ old('company_name', $profile->company_name) }}"
                               required
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('company_name') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                        @error('company_name')
                            <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tagline" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Tagline Singkat
                        </label>
                        <input type="text"
                               id="tagline"
                               name="tagline"
                               value="{{ old('tagline', $profile->tagline) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                               placeholder="Software House & Creative Agency">
                    </div>
                </div>
            </div>

            <!-- Konten Hero Landing -->
            <div class="border-b border-white/10 pb-6 space-y-5">
                <h2 class="text-xs font-mono font-bold uppercase tracking-wider text-[#34D399]">
                    2. Headline &amp; Hero Landing Page
                </h2>

                <div>
                    <label for="hero_title" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                        Judul Utama Hero <span class="text-[#34D399]">*</span>
                    </label>
                    <input type="text"
                           id="hero_title"
                           name="hero_title"
                           value="{{ old('hero_title', $profile->hero_title) }}"
                           required
                           class="w-full px-4 py-2.5 text-sm bg-black/40 border @error('hero_title') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                    @error('hero_title')
                        <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hero_subtitle" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                        Subjudul Hero
                    </label>
                    <textarea id="hero_subtitle"
                              name="hero_subtitle"
                              rows="3"
                              class="w-full p-4 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none leading-relaxed">{{ old('hero_subtitle', $profile->hero_subtitle) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                        Gambar Hero
                    </label>
                    @if (!empty($profile->hero_image))
                        <div class="mb-3 flex items-center space-x-3">
                            <img src="{{ asset('storage/' . $profile->hero_image) }}"
                                 alt="Hero Image"
                                 class="w-28 h-16 object-cover rounded-xl border border-white/10">
                            <span class="text-xs font-mono text-[#A0ADA5]">Gambar hero aktif</span>
                        </div>
                    @endif
                    <input type="file"
                           id="hero_image"
                           name="hero_image"
                           accept="image/*"
                           class="w-full px-3 py-2 text-xs bg-black/40 border border-white/10 rounded-xl text-[#A0ADA5] file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#10B981] file:text-[#080D0B] hover:file:bg-[#34D399]">
                </div>
            </div>

            <!-- Visi, Misi & Storytelling -->
            <div class="border-b border-white/10 pb-6 space-y-5">
                <h2 class="text-xs font-mono font-bold uppercase tracking-wider text-[#34D399]">
                    3. Profil Narasi, Visi &amp; Misi Studio
                </h2>

                <div>
                    <label for="about_story" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                        Kisah &amp; Narasi Perusahaan (Tampil di Halaman Tentang)
                    </label>
                    <textarea id="about_story"
                              name="about_story"
                              rows="4"
                              class="w-full p-4 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">{{ old('about_story', $profile->about_story) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="vision" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Visi Perusahaan
                        </label>
                        <textarea id="vision"
                                  name="vision"
                                  rows="3"
                                  class="w-full p-4 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">{{ old('vision', $profile->vision) }}</textarea>
                    </div>

                    <div>
                        <label for="mission" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Misi Perusahaan
                        </label>
                        <textarea id="mission"
                                  name="mission"
                                  rows="3"
                                  class="w-full p-4 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">{{ old('mission', $profile->mission) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Kontak & WhatsApp Integrasi -->
            <div class="border-b border-white/10 pb-6 space-y-5">
                <h2 class="text-xs font-mono font-bold uppercase tracking-wider text-[#34D399]">
                    4. Saluran Kontak &amp; Integrasi WhatsApp
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label for="email" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Email Publik
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $profile->email) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    </div>

                    <div>
                        <label for="phone" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Nomor Telepon Kantor
                        </label>
                        <input type="text"
                               id="phone"
                               name="phone"
                               value="{{ old('phone', $profile->phone) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    </div>

                    <div>
                        <label for="whatsapp_number" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Nomor WhatsApp Resmi
                        </label>
                        <input type="text"
                               id="whatsapp_number"
                               name="whatsapp_number"
                               value="{{ old('whatsapp_number', $profile->whatsapp_number) }}"
                               placeholder="6281234567890"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="whatsapp_template" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                        Template Pesan WhatsApp Otomatis
                    </label>
                    <input type="text"
                           id="whatsapp_template"
                           name="whatsapp_template"
                           value="{{ old('whatsapp_template', $profile->whatsapp_template) }}"
                           placeholder="Halo PT Central Saga Mandala, saya ingin berkonsultasi mengenai proyek..."
                           class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="operating_hours" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Jam Operasional
                        </label>
                        <input type="text"
                               id="operating_hours"
                               name="operating_hours"
                               value="{{ old('operating_hours', $profile->operating_hours) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none"
                               placeholder="Senin - Jumat, 09.00 - 18.00 WITA">
                    </div>

                    <div>
                        <label for="address" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Alamat Kantor Studio
                        </label>
                        <input type="text"
                               id="address"
                               name="address"
                               value="{{ old('address', $profile->address) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none"
                               placeholder="Tabanan, Bali, Indonesia">
                    </div>
                </div>
            </div>

            <!-- Tautan Media Sosial & SEO -->
            <div class="space-y-5">
                <h2 class="text-xs font-mono font-bold uppercase tracking-wider text-[#34D399]">
                    5. Media Sosial &amp; Kata Kunci SEO
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="facebook_url" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Tautan Facebook
                        </label>
                        <input type="url"
                               id="facebook_url"
                               name="facebook_url"
                               value="{{ old('facebook_url', $profile->facebook_url) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    </div>

                    <div>
                        <label for="instagram_url" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Tautan Instagram
                        </label>
                        <input type="url"
                               id="instagram_url"
                               name="instagram_url"
                               value="{{ old('instagram_url', $profile->instagram_url) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    </div>

                    <div>
                        <label for="linkedin_url" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Tautan LinkedIn
                        </label>
                        <input type="url"
                               id="linkedin_url"
                               name="linkedin_url"
                               value="{{ old('linkedin_url', $profile->linkedin_url) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    </div>

                    <div>
                        <label for="maps_url" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Tautan Google Maps
                        </label>
                        <input type="url"
                               id="maps_url"
                               name="maps_url"
                               value="{{ old('maps_url', $profile->maps_url) }}"
                               class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="seo_keywords" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                        Kata Kunci SEO Meta (Pisahkan dengan koma)
                    </label>
                    <input type="text"
                           id="seo_keywords"
                           name="seo_keywords"
                           value="{{ old('seo_keywords', $profile->seo_keywords) }}"
                           placeholder="software house bali, website company profile, flutter developer, tabanan"
                           class="w-full px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:outline-none">
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-6 border-t border-white/10 flex items-center justify-between">
                <a href="/admin" class="text-xs font-mono text-[#A0ADA5] hover:text-white">
                    &larr; Kembali ke Ringkasan
                </a>
                <button type="submit" class="btn-emerald px-8 py-3 text-xs font-mono font-semibold rounded-xl">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
