<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Veterinary Clinic Portal') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            :root {
                --brand-coral: #FF9A86;
                --brand-peach: #FFB399;
                --brand-apricot: #FFD6A6;
                --brand-cream: #FFF0BE;
            }
            .glass-effect {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="bg-[#FFF0BE] text-[#4A3732] font-sans selection:bg-[#FF9A86] selection:text-white">

        <header class="fixed top-0 w-full z-50 px-4 py-4">
            <nav class="max-w-7xl mx-auto flex items-center justify-between glass-effect px-6 py-3 rounded-2xl shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="bg-[#FF9A86] p-2 rounded-lg text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1.323l.395.17a7.527 7.527 0 013.782 3.782l.17.395H17a1 1 0 110 2h-1.323l-.17.395a7.527 7.527 0 01-3.782 3.782l-.395.17V17a1 1 0 11-2 0v-1.323l-.395-.17a7.527 7.527 0 01-3.782-3.782l-.17-.395H3a1 1 0 110-2h1.323l.17-.395a7.527 7.527 0 013.782-3.782l.395-.17V3a1 1 0 011-1z"></path></svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight hidden sm:block">VetPortal</span>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-2 sm:gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-[#FF9A86] text-white text-sm font-semibold rounded-xl hover:shadow-lg transition-all active:scale-95">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium hover:text-[#FF9A86] transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2 border-2 border-[#FF9A86] text-[#FF9A86] text-sm font-semibold rounded-xl hover:bg-[#FF9A86] hover:text-white transition-all active:scale-95">Join Us</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </header>

        <main class="min-h-screen flex items-center justify-center pt-24 pb-12 px-4">
            <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-12 items-center">

                <div class="text-center lg:text-left space-y-8 order-2 lg:order-1">
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-[#FFD6A6] text-[#FF9A86] text-xs font-bold uppercase tracking-widest">
                        🐾 Expert Care for Your Pets
                    </div>

                    <h1 class="text-4xl md:text-6xl font-extrabold text-[#4A3732] leading-tight">
                        Compassionate care <br/>
                        <span class="text-[#FF9A86]">for every paw.</span>
                    </h1>

                    <p class="text-lg text-[#706f6c] max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        Managing your pet's health shouldn't be stressful. Access medical records, schedule appointments, and connect with our specialists all in one place.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-[#FF9A86] text-white rounded-2xl font-bold shadow-xl shadow-orange-200 hover:-translate-y-1 transition-all text-center">Get Started</a>
                        <div class="flex -space-x-3 justify-center items-center">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-200 flex items-center justify-center text-[10px] font-bold">🐶</div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-200 flex items-center justify-center text-[10px] font-bold">🐱</div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-200 flex items-center justify-center text-[10px] font-bold">🐰</div>
                            <span class="pl-5 text-sm font-medium text-[#706f6c]">Trusted by 500+ Pet Parents</span>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#FF9A86] to-[#FFD6A6] rounded-3xl rotate-3 scale-105 opacity-20 blur-xl"></div>
                    <div class="relative bg-white p-4 rounded-[2rem] shadow-2xl border border-white/50 overflow-hidden">
                        <div class="aspect-square w-full bg-gradient-to-br from-[#FFD6A6] to-[#FFB399] rounded-[1.5rem] flex items-center justify-center">
                            <svg class="w-32 h-32 text-white opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm-2-12c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm4 0c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm-2 10c-2.33 0-4.322-1.455-5.116-3.5h1.161c.691 1.405 2.14 2.5 3.955 2.5s3.264-1.095 3.955-2.5h1.161c-.794 2.045-2.786 3.5-5.116 3.5z"/></svg>
                        </div>

                        <div class="absolute bottom-8 -left-6 glass-effect p-4 rounded-2xl shadow-xl hidden sm:block animate-bounce-slow">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-100 text-green-600 p-2 rounded-full">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="pr-4">
                                    <p class="text-[10px] uppercase font-bold text-[#706f6c]">Next Checkup</p>
                                    <p class="text-sm font-bold text-[#4A3732]">Today at 2:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="w-full py-8 text-center text-xs text-[#706f6c] border-t border-[#FFD6A6]/30">
            <p>&copy; {{ date('Y') }} Veterinary Clinic Portal. Made for Web Artisans.</p>
            <div class="mt-2 opacity-50">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </footer>

        <style>
            @keyframes bounce-slow {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            .animate-bounce-slow {
                animation: bounce-slow 4s ease-in-out infinite;
            }
        </style>
    </body>
</html>
