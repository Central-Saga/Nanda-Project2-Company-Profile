<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>Masuk Admin | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#080D0B] text-[#F5F7F5] font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Logo / Brand Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center p-3 rounded-2xl glass-panel shadow-xl mb-4 border border-white/10">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo {{ config('app.name') }}"
                     class="h-14 w-14 object-contain">
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-white">
                {{ config('app.name') }}
            </h1>
            <p class="text-xs font-mono text-[#34D399] mt-1 uppercase tracking-wider">
                Panel Administrasi Konten
            </p>
        </div>

        <!-- Login Card -->
        <div class="glass-panel rounded-2xl p-8 shadow-2xl border border-white/10">
            <div class="flex items-center justify-between pb-4 mb-6 border-b border-white/10">
                <h2 class="text-base font-bold text-white flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                    <span>Masuk ke Dashboard</span>
                </h2>
                <span class="text-[11px] font-mono text-[#A0ADA5]">OTENTIKASI SISTEM</span>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
                <div class="mb-6 p-4 border border-[#EF4444]/40 bg-[#EF4444]/10 rounded-xl" role="alert">
                    <p class="text-xs font-mono font-medium text-[#EF4444]">
                        {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5" novalidate>
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                        Alamat Email
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="email"
                           class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-[#101713] border border-white/10 rounded-xl text-[#F5F7F5] placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none transition-colors"
                           placeholder="admin@example.com">
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-mono uppercase font-semibold text-[#F5F7F5] mb-1.5">
                        Password
                    </label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           class="w-full min-h-[44px] px-3.5 py-2.5 text-sm bg-[#101713] border border-white/10 rounded-xl text-[#F5F7F5] placeholder-[#5E7167] focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] focus:outline-none transition-colors"
                           placeholder="••••••••">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox"
                           id="remember"
                           name="remember"
                           class="w-4 h-4 text-[#10B981] bg-[#101713] border-white/20 rounded focus:ring-[#10B981]">
                    <label for="remember" class="ml-2 text-xs font-mono text-[#A0ADA5] select-none cursor-pointer">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                            class="w-full min-h-[44px] px-4 py-3 text-sm font-semibold text-white btn-emerald rounded-xl transition-all focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#10B981]">
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>
        </div>

        <!-- Back to Website -->
        <div class="text-center mt-6">
            <a href="/" class="text-xs font-mono text-[#A0ADA5] hover:text-[#34D399] transition-colors underline underline-offset-4">
                &larr; Kembali ke halaman publik
            </a>
        </div>
    </div>

</body>
</html>
