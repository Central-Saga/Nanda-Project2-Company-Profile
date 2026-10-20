@extends('layouts.public')

@section('seo')
    <x-seo-meta
        title="Kontak & Diskusi Proyek - PT. Central Saga Mandala"
        description="Konsultasikan kebutuhan pembuatan aplikasi web, aplikasi mobile, UI/UX design, atau solusi cloud Anda bersama PT. Central Saga Mandala di Tabanan, Bali."
    />
@endsection

@section('content')
    <!-- Header Hero -->
    <section class="relative pt-16 pb-16 md:pt-20 md:pb-20 overflow-hidden bg-ambient-mesh border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center space-x-2 px-3 py-1 glass-pill rounded-full text-xs font-mono text-[#34D399] mb-4">
                <span class="text-[#10B981]">&bull;</span>
                <span>KONSULTASI &amp; INQUIRY PROYEK</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white mb-4">
                Mulai Diskusi Proyek Anda
            </h1>
            <p class="text-base sm:text-lg text-[#A0ADA5] max-w-2xl mx-auto">
                Sampaikan rencana digital Anda. Tim kami akan menganalisis kebutuhan teknis dan menyusun estimasi arsitektur terbaik untuk Anda.
            </p>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

            <!-- Left: Office & Quick Contact Channels (5 cols) -->
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-white mb-3">Informasi Studio &amp; Lokasi</h2>
                    <p class="text-sm text-[#A0ADA5] leading-relaxed">
                        Kami siap melayani pertemuan tatap muka di studio kami di Tabanan, Bali, maupun koordinasi online melalui Google Meet / Zoom.
                    </p>
                </div>

                <div class="space-y-4 font-mono text-xs">
                    <!-- WhatsApp Direct Quick Chat -->
                    @php
                        $waNum = preg_replace('/[^0-9]/', '', $siteProfile->whatsapp_number ?? ($siteProfile->phone ?? '6281234567890'));
                        $waText = urlencode($siteProfile->whatsapp_template ?? 'Halo PT Central Saga Mandala, saya ingin berdiskusi mengenai proyek perangkat lunak.');
                    @endphp
                    <div class="glass-panel rounded-2xl p-5 border border-[#10B981]/30 bg-[#10B981]/5">
                        <span class="text-[11px] uppercase text-[#34D399] font-bold block mb-1">RESPONS CEPAT VIA WHATSAPP</span>
                        <p class="text-xs text-[#A0ADA5] mb-3 font-sans">Ingin tanggapan langsung dari tim teknis kami? Hubungi kami melalui WhatsApp resmi.</p>
                        <a href="https://wa.me/{{ $waNum }}?text={{ $waText }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn-emerald inline-flex items-center space-x-2 px-4 py-2.5 text-xs font-semibold rounded-xl w-full justify-center">
                            <span>Chat WhatsApp Tim Kami</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="glass-panel rounded-2xl p-5 border border-white/10">
                        <span class="text-[11px] uppercase text-[#A0ADA5] block mb-1">EMAIL RESMI</span>
                        <a href="mailto:{{ $siteProfile->email ?? 'info@centralsaga.com' }}" class="text-white hover:text-[#34D399] text-sm font-semibold underline underline-offset-4">
                            {{ $siteProfile->email ?? 'info@centralsaga.com' }}
                        </a>
                    </div>

                    <!-- Phone -->
                    <div class="glass-panel rounded-2xl p-5 border border-white/10">
                        <span class="text-[11px] uppercase text-[#A0ADA5] block mb-1">TELEPON</span>
                        <span class="text-white text-sm font-semibold">{{ $siteProfile->phone ?? '+62 812-3456-7890' }}</span>
                    </div>

                    <!-- Address -->
                    <div class="glass-panel rounded-2xl p-5 border border-white/10">
                        <span class="text-[11px] uppercase text-[#A0ADA5] block mb-1">ALAMAT STUDIO</span>
                        <p class="text-white text-xs leading-relaxed font-sans mb-3">
                            {{ $siteProfile->address ?? 'Tabanan, Bali, Indonesia' }}
                        </p>
                        @if (!empty($siteProfile->maps_url))
                            <a href="{{ $siteProfile->maps_url }}" target="_blank" rel="noopener noreferrer" class="text-[#34D399] hover:underline flex items-center space-x-1">
                                <span>Buka di Google Maps</span>
                                <span>&nearr;</span>
                            </a>
                        @endif
                    </div>

                    <!-- Operating Hours -->
                    @if (!empty($siteProfile->operating_hours))
                        <div class="glass-panel rounded-2xl p-5 border border-white/10">
                            <span class="text-[11px] uppercase text-[#A0ADA5] block mb-1">JAM OPERASIONAL STUDIO</span>
                            <span class="text-white text-xs">{{ $siteProfile->operating_hours }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Detailed Inquiry Form (7 cols) -->
            <div class="lg:col-span-7 glass-panel rounded-3xl p-8 sm:p-10 border border-white/10 shadow-2xl">
                <div class="mb-6">
                    <span class="text-xs uppercase font-mono font-bold text-[#34D399] tracking-wider block mb-1">FORMULIR INQUIRY PROYEK</span>
                    <h3 class="text-2xl font-bold text-white">Ceritakan Rencana Anda</h3>
                    <p class="text-xs text-[#A0ADA5] mt-1">Kami akan mengkaji detail kebutuhan dan memberikan estimasi awal dalam 1x24 jam kerja.</p>
                </div>

                @if (session('success'))
                    <div class="mb-6 p-4 border border-[#10B981]/40 bg-[#10B981]/15 rounded-xl text-sm font-medium text-[#10B981]" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5" novalidate>
                    @csrf

                    <!-- Honeypot -->
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="inquiry-name" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Nama Lengkap <span class="text-[#34D399]">*</span>
                            </label>
                            <input type="text"
                                   id="inquiry-name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   class="w-full min-h-[44px] px-4 py-2.5 text-sm bg-black/40 border @error('name') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                                   placeholder="Contoh: Budi Santoso">
                            @error('name')
                                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="inquiry-email" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Alamat Email <span class="text-[#34D399]">*</span>
                            </label>
                            <input type="email"
                                   id="inquiry-email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full min-h-[44px] px-4 py-2.5 text-sm bg-black/40 border @error('email') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                                   placeholder="nama@perusahaan.com">
                            @error('email')
                                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- WhatsApp Phone -->
                        <div>
                            <label for="inquiry-phone" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Nomor WhatsApp / Telepon
                            </label>
                            <input type="tel"
                                   id="inquiry-phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full min-h-[44px] px-4 py-2.5 text-sm bg-black/40 border @error('phone') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                                   placeholder="Contoh: 081234567890">
                            @error('phone')
                                <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Perusahaan -->
                        <div>
                            <label for="inquiry-company" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Nama Perusahaan / Institusi (Opsional)
                            </label>
                            <input type="text"
                                   id="inquiry-company"
                                   name="company_name"
                                   value="{{ old('company_name') }}"
                                   class="w-full min-h-[44px] px-4 py-2.5 text-sm bg-black/40 border border-white/10 rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                                   placeholder="Nama Perusahaan">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Jenis Layanan -->
                        <div>
                            <label for="inquiry-service" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Jenis Layanan
                            </label>
                            <select id="inquiry-service"
                                    name="service_type"
                                    class="w-full min-h-[44px] px-4 py-2.5 text-sm bg-[#101713] border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                                <option value="">-- Pilih Jenis Layanan --</option>
                                <option value="Aplikasi Web & SaaS" {{ request('service') == 'Aplikasi Web & SaaS' || old('service_type') == 'Aplikasi Web & SaaS' ? 'selected' : '' }}>Aplikasi Web &amp; SaaS</option>
                                <option value="Aplikasi Mobile (iOS/Android)" {{ request('service') == 'Aplikasi Mobile (iOS/Android)' || old('service_type') == 'Aplikasi Mobile (iOS/Android)' ? 'selected' : '' }}>Aplikasi Mobile (iOS/Android)</option>
                                <option value="Desain UI/UX & Brand Digital" {{ request('service') == 'Desain UI/UX & Brand Digital' || old('service_type') == 'Desain UI/UX & Brand Digital' ? 'selected' : '' }}>Desain UI/UX &amp; Brand Digital</option>
                                <option value="Infrastruktur Cloud & DevOps" {{ request('service') == 'Infrastruktur Cloud & DevOps' || old('service_type') == 'Infrastruktur Cloud & DevOps' ? 'selected' : '' }}>Infrastruktur Cloud &amp; DevOps</option>
                                <option value="Sistem ERP / Custom Backend" {{ request('service') == 'Sistem ERP / Custom Backend' || old('service_type') == 'Sistem ERP / Custom Backend' ? 'selected' : '' }}>Sistem ERP / Custom Backend</option>
                                <option value="Konsultasi & Audit Teknologi" {{ request('service') == 'Konsultasi & Audit Teknologi' || old('service_type') == 'Konsultasi & Audit Teknologi' ? 'selected' : '' }}>Konsultasi &amp; Audit Teknologi</option>
                                <option value="Lainnya" {{ old('service_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Estimasi Budget -->
                        <div>
                            <label for="inquiry-budget" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                                Estimasi Anggaran
                            </label>
                            <select id="inquiry-budget"
                                    name="budget_range"
                                    class="w-full min-h-[44px] px-4 py-2.5 text-sm bg-[#101713] border border-white/10 rounded-xl text-white focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none">
                                <option value="">-- Pilih Estimasi Anggaran --</option>
                                <option value="< Rp 25 Juta" {{ old('budget_range') == '< Rp 25 Juta' ? 'selected' : '' }}>&lt; Rp 25 Juta</option>
                                <option value="Rp 25 Juta - Rp 50 Juta" {{ old('budget_range') == 'Rp 25 Juta - Rp 50 Juta' ? 'selected' : '' }}>Rp 25 Juta - Rp 50 Juta</option>
                                <option value="Rp 50 Juta - Rp 100 Juta" {{ old('budget_range') == 'Rp 50 Juta - Rp 100 Juta' ? 'selected' : '' }}>Rp 50 Juta - Rp 100 Juta</option>
                                <option value="> Rp 100 Juta" {{ old('budget_range') == '> Rp 100 Juta' ? 'selected' : '' }}>&gt; Rp 100 Juta (Enterprise)</option>
                                <option value="Fleksibel / Belum Ditentukan" {{ old('budget_range') == 'Fleksibel / Belum Ditentukan' ? 'selected' : '' }}>Fleksibel / Belum Ditentukan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Subjek -->
                    <div>
                        <label for="inquiry-subject" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Subjek / Judul Kebutuhan <span class="text-[#34D399]">*</span>
                        </label>
                        <input type="text"
                               id="inquiry-subject"
                               name="subject"
                               value="{{ old('subject') }}"
                               required
                               class="w-full min-h-[44px] px-4 py-2.5 text-sm bg-black/40 border @error('subject') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                               placeholder="Contoh: Pembuatan Sistem Manajemen Operasional Pabrik">
                        @error('subject')
                            <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kebutuhan Proyek -->
                    <div>
                        <label for="inquiry-message" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                            Deskripsi Kebutuhan Proyek <span class="text-[#34D399]">*</span>
                        </label>
                        <textarea id="inquiry-message"
                                  name="message"
                                  rows="5"
                                  required
                                  class="w-full p-4 text-sm bg-black/40 border @error('message') border-[#EF4444] @else border-white/10 @enderror rounded-xl text-white placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none"
                                  placeholder="Ceritakan gambaran sistem, kendala bisnis saat ini, target pengguna, dan jadwal yang diharapkan...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-[#EF4444] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                                class="btn-emerald w-full min-h-[48px] px-8 py-3.5 text-sm font-semibold rounded-xl flex items-center justify-center space-x-2 shadow-lg">
                            <span>Kirimkan Formulir Inquiry</span>
                            <span>&rarr;</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection

