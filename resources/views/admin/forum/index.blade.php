<x-app-layout>
    {{-- Ini adalah tempat Anda menempatkan CSS kustom jika tidak menggunakan Tailwind --}}

    {{-- Layout Sesuai Gambar: Sidebar Hijau Gelap & Konten --}}
    <div class="flex min-h-screen bg-gray-100">
        
        {{-- Sidebar (Sesuai Desain Gambar) --}}
        <div class="w-64 bg-[#38761D] text-white p-4 shadow-lg flex flex-col justify-between">
            <div>
                {{-- Logo Nexterra (Ganti dengan komponen logo Anda jika ada) --}}
                <div class="mb-8 p-2">
                    {{-- Ganti dengan tag gambar logo yang Anda simpan di public/images/ --}}
                    <img src="{{ asset('images/nexterra-logo.png') }}" alt="Nexterra Logo" class="max-w-full h-auto">
                </div>
                
                {{-- Menu Navigasi --}}
                <nav class="space-y-2">
                    @php
                        // DEFINE ARRAY MENU ITEMS DAHULU
                        $menuItems = [
                            ['name' => 'Forum Diskusi', 'route' => 'admin.forum.index'],
                            ['name' => 'Pengguna', 'route' => 'admin.users.index'],
                            ['name' => 'Edukasi', 'route' => 'education.index'],
                            ['name' => 'Hewan Langka', 'route' => 'endangered_animals.index'],
                            ['name' => 'Peta', 'route' => 'map.index'],
                            ['name' => 'Berita', 'route' => 'news.index'],
                            ['name' => 'Media Partner', 'route' => 'media_partner.index'],
                        ];
                    @endphp

                    @foreach ($menuItems as $item)
                        {{-- Logika penentuan $href dan $isActive HARUS di dalam loop --}}
                        @php
                            $href = ($item['route'] == '#') ? '#' : route($item['route']);
                            $isActive = ($item['route'] != '#') && Route::is($item['route']);
                        @endphp
                        
                        <a href="{{ $href }}" class="block p-2 rounded 
                            @if($isActive) bg-[#6AA84F] font-bold @else hover:bg-[#6AA84F]/50 @endif
                        ">{{ $item['name'] }}</a>
                    @endforeach
                </nav>
            </div>
            
            {{-- Tombol Beranda --}}
            <a href="{{ route('dashboard') }}" class="mt-8 p-3 text-center rounded bg-[#D39962] hover:bg-[#C58C5A] text-white font-bold transition duration-150">
                Beranda
            </a>
        </div>

        {{-- Konten Utama Forum Diskusi --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <h1 class="text-3xl font-bold mb-8 text-[#38761D]">Forum Diskusi</h1>

            {{-- Kotak Telusuri --}}
            <div class="mb-8 flex items-center bg-white shadow-md p-4 rounded-lg border border-gray-200">
                <input type="text" placeholder="Telusuri" class="w-full p-2 border-0 focus:ring-0 focus:outline-none text-lg">
                <button class="bg-[#38761D] text-white p-2 rounded-lg hover:bg-[#4A902C] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Daftar Diskusi (Admin View) --}}
            <div class="space-y-4">
                @forelse ($discussions as $discussion)
                    <div class="flex items-center justify-between bg-white p-4 rounded-lg shadow-md border border-gray-200">
                        {{-- Icon User --}}
                        <div class="flex items-center space-x-4 w-full">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            
                            <div class="flex-grow">
                                <p class="text-sm font-semibold text-gray-700">Nama Akun: {{ $discussion->user->name }}</p>
                                <p class="text-base text-gray-900">{{ $discussion->content }}</p>
                            </div>
                        </div>

                        {{-- Tombol Hapus (Khusus Admin) --}}
                        <form method="POST" action="{{ route('admin.forum.destroy', $discussion) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus diskusi ini?');" class="flex-shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded bg-red-600 text-white hover:bg-red-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada diskusi yang dibuat oleh pengguna.</p>
                @endforelse
            </div>
        </main>
    </div>
</x-app-layout>