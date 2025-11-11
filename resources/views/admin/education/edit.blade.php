<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar (Menu Navigasi) --}}
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

                    @foreach ($menuItems as $p)
                        @php
                            $href = ($p['route'] == '#') ? '#' : route($p['route']);
                            $isActive = ($p['route'] != '#') && (Route::is($p['route']) || (str_contains($p['route'], 'education') && request()->routeIs('education.*')));
                        @endphp
                        
                        <a href="{{ $href }}" class="block p-2 rounded 
                            @if($isActive) bg-[#6AA84F] font-bold @else hover:bg-[#6AA84F]/50 @endif
                        ">{{ $p['name'] }}</a>
                    @endforeach
                </nav>
            </div>
            <a href="{{ route('dashboard') }}" class="mt-8 p-3 text-center rounded bg-[#D39962] hover:bg-[#C58C5A] text-white font-bold transition duration-150">
                Beranda
            </a>
        </div>

        {{-- Konten Form Edit Edukasi --}}
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

            {{-- Form Edit Edukasi --}}
            <div class="bg-[#38761D] p-6 rounded-lg shadow-2xl text-white max-w-5xl mx-auto mt-12">
                <h2 class="text-2xl font-bold mb-6">Edit Konten Edukasi</h2>
                <form action="{{ route('education.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Penting untuk UPDATE --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kolom Kiri: Judul dan Paragraf --}}
                        <div>
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium mb-1">Judul Edukasi</label>
                                {{-- KOREKSI: bg-gray-700 -> bg-white, text-white -> text-gray-900 --}}
                                <input type="text" id="title" name="title" class="w-full p-2 rounded bg-white border border-gray-600 focus:ring focus:ring-gray-500 text-gray-900" value="{{ old('title', $item->title) }}" placeholder="Orang Utan (Pongo)">
                                @error('title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="block text-sm font-medium mb-1">Foto Edukasi</label>
                                <div class="flex items-center space-x-2 w-full p-2 rounded bg-white border border-gray-600 text-gray-900">
                                    {{-- Tombol Choose File (Label) --}}
                                    <label for="image_upload_input" class="py-2 px-4 rounded-full border-0 text-sm font-semibold bg-[#6AA84F] text-white hover:bg-[#5C9041] cursor-pointer">
                                        Choose File
                                    </label>
                                    {{-- Input File --}}
                                    <input type="file" id="image_upload_input" name="image" class="hidden" onchange="document.getElementById('file_name_display').innerText = this.files[0] ? this.files[0].name : 'No file chosen'">
                                    {{-- Nama File Display --}}
                                    @error('image') 
                                    <span id="file_name_display" class="text-gray-900">
                                        {{ $item->image_path ? basename($item->image_path) : 'No file chosen' }}
                                    </span>
                                    @enderror
                                </div>
                                @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="content" class="block text-sm font-medium mb-1">Paragraf Edukasi</label>
                                {{-- KOREKSI: bg-gray-700 -> bg-white, text-white -> text-gray-900 --}}
                                <textarea id="content" name="content" rows="8" class="w-full p-2 rounded bg-white border border-gray-600 focus:ring focus:ring-gray-500 text-gray-900">{{ old('content', $item->content) }}</textarea>
                                @error('content') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Kolom Kanan: Preview/Kontrol --}}
                        <div class="flex flex-col justify-between">
                            <div class="bg-white p-4 rounded flex flex-col items-center justify-center text-gray-800 font-bold h-full border border-gray-200">
                                @if ($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover rounded shadow-md">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded text-gray-500">
                                        <svg class="h-20 w-20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L15 14l5-5m-5 5a2 2 0 110 4 2 2 0 010-4z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex justify-end space-x-4 mt-6">
                                <a href="{{ route('education.index') }}" class="bg-[#B03C36] hover:bg-[#97332E] text-white font-bold py-2 px-6 rounded transition duration-150">Batal</a>
                                <button type="submit" class="bg-[#6AA84F] hover:bg-[#5C9041] text-white font-bold py-2 px-6 rounded transition duration-150">Update</button>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Tambah Tombol Delete di bawah form (opsional) --}}
                <form action="{{ route('education.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten edukasi ini?');" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition duration-150">Hapus Konten</button>
                </form>
            </div>
        </main>
    </div>
</x-app-layout>