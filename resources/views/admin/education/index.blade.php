@php
    // Definisikan layout yang digunakan oleh admin sidebar
    $adminLayout = 'layouts.app';
    // Pastikan folder view telah dibuat: resources/views/admin/education
@endphp
<x-app-layout>
    <div class="flex min-h-screen bg-gray-100 relative">
        {{-- Sidebar --}}
        <div class="w-64 bg-[#38761D] text-white p-4 shadow-lg flex flex-col justify-between">
            <div>
                <div class="mb-8 p-2">
                    <img src="{{ asset('images/nexterra-logo.png') }}" alt="Nexterra Logo" class="max-w-full h-auto">
                </div>
                <nav class="space-y-2">
                    @php
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
                            $isActive = ($item['route'] != '#') && (Route::is($item['route']) || (str_contains($item['route'], 'education') && request()->routeIs('education.*')));
                        @endphp
                        
                        <a href="{{ $href }}" class="block p-2 rounded 
                            @if($isActive) bg-[#6AA84F] font-bold @else hover:bg-[#6AA84F]/50 @endif
                        ">{{ $item['name'] }}</a>
                    @endforeach
                </nav>
            </div>
            <a href="{{ route('dashboard') }}" class="mt-8 p-3 text-center rounded bg-[#D39962] hover:bg-[#C58C5A] text-white font-bold transition duration-150">
                Beranda
            </a>
        </div>

        {{-- Konten Utama Edukasi --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <h1 class="text-3xl font-bold mb-8 text-[#38761D]">Edukasi</h1>

            {{-- Kotak Telusuri --}}
            <div class="mb-8 flex items-center bg-white shadow-md p-4 rounded-lg border border-gray-200">
                <input type="text" placeholder="Telusuri" class="w-full p-2 border-0 focus:ring-0 focus:outline-none text-lg">
                <button class="bg-[#38761D] text-white p-2 rounded-lg hover:bg-[#4A902C] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Grid Daftar Edukasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($education_items as $item)
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
            
            {{-- Bagian Gambar --}}
            @if ($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                {{-- Diubah h-32 menjadi h-48 agar lebih proporsional seperti gambar --}}
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500 text-sm">No Image</span>
                </div>
            @endif
            
            {{-- Konten Teks dan Tombol --}}
            <div class="p-4"> 
                {{-- Konten Teks (Menggantikan 'ooook' pada gambar) --}}
                <h3 class="font-bold text-lg text-gray-800 mb-3">{{ $item->title ?? 'Judul Tidak Ada' }}</h3>
                
                {{-- Konten Deskripsi Singkat (Opsional) --}}
                <p class="text-sm text-gray-600 mb-3">{{ Str::limit($item->content ?? '', 50) }}</p>

                {{-- Grup Tombol Detail & Hapus --}}
                <div class="flex space-x-2 mt-4">
                    {{-- Tombol Detail/Edit (Route show digunakan untuk Edit Form Admin) --}}
                    <a href="{{ route('education.show', $item) }}" class="flex-1 text-center bg-[#6AA84F] hover:bg-[#5C9041] text-white font-bold py-2 px-4 rounded transition duration-150">
                        Detail
                    </a>

                    {{-- Form Delete --}}
                    <form action="{{ route('education.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten {{ $item->title ?? "ini" }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                            Hapus
                        </button>
                    </form>
                </div>
            </div> {{-- End of p-4 --}}
            
        </div>
    @empty
        <p class="col-span-3 text-gray-500">Belum ada konten edukasi yang dibuat.</p>
    @endforelse
</div>
        </main>

        {{-- Tombol Tambah (Fixed, Pojok Kanan Bawah) --}}
        <a href="{{ route('education.create') }}" class="fixed bottom-8 right-8 bg-[#38761D] hover:bg-[#4A902C] text-white p-4 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>
    </div>
</x-app-layout>