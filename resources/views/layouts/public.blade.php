{{-- resources/views/layouts/public.blade.php --}}
@php
    $isLoggedIn = Auth::check();
    $partners = \App\Models\MediaPartner::latest()->limit(4)->get(); // Ambil data partner untuk footer
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nexterra</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#f5f5f5]">

    {{-- NAVIGATION BAR (Dibuat sekali di sini) --}}
    <nav class="bg-[#38761D] shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- KELOMPOK UTAMA: Logo Kiri | Navigasi Tengah/Kanan | Profil Kanan --}}
        <div class="flex justify-between h-16 items-center w-full">
            
            {{-- KELOMPOK A: Logo nexTerra (Kiri Jauh) --}}
            <div class="flex items-center flex-shrink-0">
                <a href="{{ route('beranda') }}" class="text-xl font-bold text-yellow-400">nexTerra</a>
            </div>

            {{-- KELOMPOK B: Navigasi Utama (Tengah/Kanan) --}}
                        <div class="flex items-center space-x-6 flex-grow justify-end pr-8">
                <a href="{{ route('beranda') }}" class="text-sm text-white hover:text-yellow-400">Beranda</a>
                <a href="{{ route('news.index') }}" class="text-sm text-white hover:text-yellow-400">Berita</a>
                <a href="{{ route('education.index') }}" class="text-sm text-white hover:text-yellow-400">Edukasi</a>
                <a href="{{ route('endangered_animals.index') }}" class="text-sm text-white hover:text-yellow-400">Hewan Langka</a>
                <a href="{{ route('map.index') }}" class="text-sm text-white hover:text-yellow-400">Peta</a>
                <a href="{{ route('forum.index') }}" class="text-sm text-white hover:text-yellow-400">Forum Diskusi</a>
            </div>

            {{-- KELOMPOK C: User Icon (Kanan Jauh) --}}
            <div class="flex items-center flex-shrink-0">
                @auth
                <a href="{{ route('profile.view') }}" class="flex items-center space-x-1 text-sm text-white hover:text-yellow-400">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    <span class="text-white hover:text-yellow-400">{{ Auth::user()->name }}</span>
                </a>
                @else
                <a href="{{ route('login') }}" class="text-sm text-white hover:text-yellow-400">Login</a>
                @endauth
            </div>

        </div>
    </div>
</nav>

    <main class="min-h-screen">
        {{-- SLOT CONTENT --}}
        @yield('content') 
    </main>
    
    {{-- FOOTER --}}
    <footer class="bg-[#38761D] text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            {{-- Media Sosial Kiri --}}
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/" class="hover:text-gray-300"><img src="{{ asset('images/facebook_icon.png') }}" alt="FB" class="h-6 w-6"></a>
                <a href="https://x.com/" class="hover:text-gray-300"><img src="{{ asset('images/x_icon.png') }}" alt="Twitter" class="h-6 w-8"></a>
                <a href="https://www.youtube.com/" class="hover:text-gray-300"><img src="{{ asset('images/youtube_icon.png') }}" alt="YouTube" class="h-6 w-6"></a>
            </div>
            
            {{-- Logo Partner Kanan (MAX 4) --}}
            <div class="flex flex-col items-end">
                <p class="text-sm font-semibold mb-2">Media Partner Kami</p>
                <div class="flex space-x-4 items-center">
                    @forelse ($partners as $partner)
                        <a href="{{ $partner->link ?? '#' }}" target="_blank" class="block">
                            <img src="{{ asset('storage/' . $partner->logo_path) }}" 
                                 alt="{{ $partner->name }}" 
                                 class="h-10 object-contain hover:opacity-80 transition duration-150">
                        </a>
                    @empty
                        <p class="text-xs text-gray-300">Belum ada mitra.</p>
                    @endforelse
                    
                    @if (\App\Models\MediaPartner::count() > 4)
                        <a href="{{ route('media_partner.index') }}" class="text-sm text-gray-300 hover:text-white underline ml-4">
                            View All ({{ \App\Models\MediaPartner::count() }})
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </footer>
</body>
</html>