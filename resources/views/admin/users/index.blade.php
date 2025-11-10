<x-app-layout>
    {{-- Layout Sesuai Gambar: Sidebar Hijau Gelap & Konten --}}
    <div class="flex min-h-screen bg-gray-100">
        
        {{-- Sidebar (Menu Navigasi) --}}
        <div class="w-64 bg-[#38761D] text-white p-4 shadow-lg flex flex-col justify-between">
            <div>
                {{-- Logo Nexterra --}}
                <div class="mb-8 p-2">
                    <img src="{{ asset('images/nexterra-logo.png') }}" alt="Nexterra Logo" class="max-w-full h-auto">
                </div>
                
                {{-- Menu Navigasi --}}
                <nav class="space-y-2">
                    @php
                        // Definisikan item menu. Perhatikan 'admin.users.index' sekarang memiliki rute nyata.
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

        {{-- Konten Utama Daftar Pengguna --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <h1 class="text-3xl font-bold mb-8 text-[#38761D]">Pengguna</h1>

            {{-- Kotak Telusuri --}}
            <div class="mb-8 flex items-center bg-white shadow-md p-4 rounded-lg border border-gray-200">
                <input type="text" placeholder="Telusuri" class="w-full p-2 border-0 focus:ring-0 focus:outline-none text-lg">
                <button class="bg-[#38761D] text-white p-2 rounded-lg hover:bg-[#4A902C] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Header Tabel --}}
            <div class="bg-[#38761D] text-white p-3 rounded-t-lg shadow-md mb-2 flex">
                <div class="w-20 font-bold">ID Pengguna</div>
                <div class="w-40 font-bold">Nama Pengguna</div>
                <div class="w-60 font-bold">Email</div>
                <div class="w-32 font-bold">Deskripsi</div>
                <div class="w-32 font-bold">Media Sosial</div>
                <div class="w-16 font-bold text-center">Aksi</div>
            </div>

            {{-- Daftar Pengguna --}}
            <div class="space-y-2">
                @forelse ($users as $index => $user)
                    <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200 flex items-center">
                        {{-- Data Dummy untuk ID Pengguna (Karena ID bisa berubah/dihapus, kita tampilkan ID database atau index) --}}
                        <div class="w-20">{{ $user->id }}</div>
                        <div class="w-40 font-medium">{{ $user->name }}</div>
                        <div class="w-60 text-sm text-gray-600">{{ $user->email }}</div>
                        
                        {{-- Data Dummy (Perlu kolom tambahan di DB jika mau real) --}}
                        <div class="w-32">{{ ($index % 2 == 0) ? 'Pendek' : 'Panjang' }}</div>
                        <div class="w-32">{{ ['Tiktok', 'Instagram', 'Twitter', 'Facebook', 'Douyin', 'Weibo'][rand(0, 5)] }}</div>
                        
                        {{-- Tombol Hapus (Aksi) --}}
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }}?');" class="w-16 flex justify-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded hover:bg-red-100 text-red-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500 p-4">Saat ini belum ada pengguna terdaftar (selain Admin).</p>
                @endforelse
            </div>
        </main>
    </div>
</x-app-layout>