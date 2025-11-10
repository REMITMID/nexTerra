<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar (Menu Navigasi) --}}
        {{-- ... (gunakan kode sidebar dari file index.blade.php) ... --}}
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
                            $isActive = ($item['route'] != '#') && (Route::is($item['route']) || (str_contains($item['route'], 'map') && request()->routeIs('map.*')));
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

        {{-- Konten Form Edit Peta --}}
        <main class="flex-1 p-8 overflow-y-auto">
            <h1 class="text-3xl font-bold mb-8 text-[#38761D]">Peta</h1>

            {{-- Kotak Telusuri --}}
            <div class="mb-8 flex items-center bg-white shadow-md p-4 rounded-lg border border-gray-200">
                <input type="text" placeholder="Telusuri" class="w-full p-2 border-0 focus:ring-0 focus:outline-none text-lg">
                <button class="bg-[#38761D] text-white p-2 rounded-lg hover:bg-[#4A902C] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Form Edit Peta --}}
            <div class="bg-[#38761D] p-6 rounded-lg shadow-md text-white">
                <div class="flex justify-between">
                    <h2 class="text-2xl font-bold mb-6">Edit Data Peta</h2>
                </div>

                <form action="{{ route("map.update", $map) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Penting untuk UPDATE --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kolom Kiri: Nama dan Deskripsi --}}
                        <div>
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium mb-1">Nama Peta</label>
                                <input type="text" id="name" name="name" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring focus:ring-gray-500 text-white" value="{{ old('name', $map->name) }}" placeholder="Contoh: Indonesia">
                                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="block text-sm font-medium mb-1">Foto Peta</label>
                                <input type="file" id="image" name="image" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#6AA84F] file:text-white hover:file:bg-[#5C9041]">
                                @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                                @if ($map->image_path)
                                    <p class="text-sm text-gray-300 mt-2">Peta saat ini:</p>
                                    <img src="{{ asset('storage/' . $map->image_path) }}" alt="{{ $map->name }}" class="mt-2 w-32 h-32 object-contain rounded">
                                @endif
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium mb-1">Deskripsi Peta</label>
                                <textarea id="description" name="description" rows="5" class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring focus:ring-gray-500 text-white">{{ old('description', $map->description) }}</textarea>
                                @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Kolom Kanan: Preview --}}
                        <div class="bg-white p-4 rounded flex items-center justify-center text-gray-800 font-bold" style="min-height: 250px;">
                            <h3 class="text-xl">Preview Peta</h3>
                        </div>
                    </div>

                    <div class="flex justify-between items-center space-x-4 mt-6">
                    {{-- Tombol Hapus --}}
                    <!-- <form action="{{ route('map.destroy', $map) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Peta ini? Ini juga akan menghapus semua Hewan Langka yang terkait.');"> -->
                        <!-- @csrf -->
                        <!-- @method('DELETE') -->
                        <button type="button" onclick="deleteMap()" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded transition duration-150">Hapus Peta</button>
                    <!-- </form>     -->
                    <div class="flex space-x-4">
                            <a href="{{ route('map.index') }}" class="bg-[#B03C36] hover:bg-[#97332E] text-white font-bold py-2 px-6 rounded transition duration-150">Batal</a>
                            <button type="submit" class="bg-[#6AA84F] hover:bg-[#5C9041] text-white font-bold py-2 px-6 rounded transition duration-150">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        async function deleteMap() {
            if (confirm('Apakah Anda yakin ingin menghapus Peta ini? Ini juga akan menghapus semua Hewan Langka yang terkait.')) {
                try {
                    const response = await fetch("{{ route('map.destroy', $map) }}", {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    });

                    if (response.ok) {
                        alert('Peta berhasil dihapus.');
                        window.location.href = "{{ route('map.index') }}";
                    } else {
                        alert('Gagal menghapus peta. Silakan coba lagi.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus peta.');
                }
            }
        }
    </script>
</x-app-layout>