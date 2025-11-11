@php
    use App\Models\Map;
    $maps = Map::all();
@endphp

<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar (Sama seperti index) --}}
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
                            $isActive = ($item['route'] == 'endangered_animals.index' && request()->routeIs('endangered_animals.*')) || ($item['route'] != '#' && Route::is($item['route']));
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

        {{-- Konten Form Edit Hewan Langka --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <h1 class="text-3xl font-bold mb-8 text-[#38761D]">Hewan Langka</h1>

            {{-- Kotak Telusuri --}}
            <div class="mb-8 flex items-center bg-white shadow-md p-4 rounded-lg border border-gray-200">
                <input type="text" placeholder="Telusuri" class="w-full p-2 border-0 focus:ring-0 focus:outline-none text-lg">
                <button class="bg-[#38761D] text-white p-2 rounded-lg hover:bg-[#4A902C] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Form Edit Hewan Langka --}}
            <div class="bg-[#38761D] p-6 rounded-lg shadow-2xl text-white max-w-5xl mx-auto mt-12">
                    <form action="{{ route('endangered_animals.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- KOLOM KIRI: Input Teks --}}
                            <div>
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium mb-1">Nama Hewan</label>
                                    <input type="text" id="name" name="name" class="w-full p-2 rounded bg-gray border border-gray-600 focus:ring focus:ring-gray-500 text-gray-900" value="{{ old('name', $animal->name) }}" placeholder="Orang Utan (Pongo)">
                                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="image_upload" class="block text-sm font-medium mb-1">Foto Hewan</label>
                                    <div class="flex items-center space-x-2 w-full p-2 rounded bg-white border border-gray-600 text-gray-900">
                                        {{-- Tombol Pilih File --}}

                                        <label for="image_upload" class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-white hover:file:bg-[#5C9041] cursor-pointer">
                                        </label>
                                        <input type="file" id="image" name="image" class="w-full p-2 rounded bg-white-700 border border-white-600 text-gray file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#6AA84F] file:text-white hover:file:bg-[#5C9041]">
                        @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror

                                    </div>
                                    @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="map_id" class="block text-sm font-medium mb-1">Asal Hewan</label>
                                    <select id="map_id" name="map_id" class="w-full p-2 rounded bg-white border border-gray-600 focus:ring focus:ring-gray-500 text-gray-900">
                                        <option value="">-- Pilih Lokasi Peta --</option>
                                        @foreach ($maps as $map)
                                            <option value="{{ $map->id }}" {{ old('map_id', $animal->map_id) == $map->id ? 'selected' : '' }}>
                                                {{ $map->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('map_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="description" class="block text-sm font-medium mb-1">Deskripsi Hewan</label>
                                    <textarea id="description" name="description" rows="5" class="w-full p-2 rounded bg-white border border-gray-600 focus:ring focus:ring-gray-500 text-gray-900">{{ old('description', $animal->description) }}</textarea>
                                    @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- KOLOM KANAN: Gambar Preview dan Tombol Update --}}
                            <div class="flex flex-col justify-end items-center">
                                <div class="w-full bg-white rounded-lg shadow-md overflow-hidden flex items-center justify-center p-2 mb-4 flex-grow">
                                    @if ($animal->image_path)
                                        <img src="{{ asset('storage/' . $animal->image_path) }}" alt="{{ $animal->name }}" class="w-full h-auto max-h-96 object-cover rounded">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">No Image Preview</div>
                                    @endif
                                </div>

                                {{-- Tombol Update dan Batal (DIKOREKSI AGAR SEPERTI GAMBAR) --}}
                                <div class="flex justify-end w-full space-x-4 mt-auto">
                                    <a href="{{ route('endangered_animals.index') }}" class="bg-[#B03C36] hover:bg-[#97332E] text-white font-bold py-2 px-6 rounded transition duration-150">Batal</a>
                                    <button type="submit" class="bg-[#6AA84F] hover:bg-[#5C9041] text-white font-bold py-2 px-6 rounded transition duration-150">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    {{-- Tombol Hapus Konten (Berada di luar form UPDATE) --}}
                    <form action="{{ route('endangered_animals.destroy', $animal) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus hewan ini?');" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition duration-150">Hapus Konten</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>