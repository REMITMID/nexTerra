@extends('layouts.public')

@section('content')
    <main class="min-h-screen">
        {{-- HERO SECTION --}}
        <div class="relative h-[60vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    The Detrimental Impact of Non-Accessible Animal Education Programs
                </h1>
            </div>
        </div>

        {{-- SECTION 1: APA SIH? HEWAN LANGKA ITU! --}}
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                {{-- Gambar Kiri --}}
                <div class="col-span-1 space-y-4">
                    <div class="bg-cover bg-center h-48 rounded-lg shadow-md" style="background-image: url('{{ asset('images/leopard.png') }}');"></div>
                    <div class="flex items-center space-x-4">
                        <div class="text-3xl font-bold">25 +</div>
                        <div class="text-sm text-gray-600">Hewan Langka Terdaftar</div>
                    </div>
                    <div class="bg-cover bg-center h-48 rounded-lg shadow-md" style="background-image: url('{{ asset('images/elephant.jpeg') }}');"></div>
                </div>

                {{-- Konten Tengah --}}
                <div class="col-span-2">
                    <p class="text-sm text-gray-500 mb-2">◎ ABOUT US</p>
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">
                        APA SIH? HEWAN LANGKA ITU!
                    </h2>
                    <p class="text-gray-700 mb-6">
                        {!! $latest_education->content ?? 'Hewan langka adalah spesies hewan yang jumlah populasinya sangat sedikit dan keberadaannya semakin jarang ditemukan di alam liar. Penurunan jumlah hewan langka biasanya terjadi akibat aktivitas manusia.' !!}
                    </p>
                    <a href="{{ route('education.index') }}" class="inline-block bg-[#6AA84F] hover:bg-[#5C9041] text-white font-semibold py-2 px-6 rounded transition duration-150">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        
        {{-- SECTION 2: MENGENAL HEWAN LANGKA DI DUNIA --}}
        <div class="bg-gray-50 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">
                        Mengenali Hewan Langka di Dunia
                    </h2>
                    <a href="{{ route('endangered_animals.index') }}" class="text-sm text-gray-600 hover:text-[#38761D] font-semibold">
                        VIEW ALL →
                    </a>
                </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse ($animals as $animal)
                    {{-- Setiap item adalah link ke halaman detail --}}
                    <a href="{{ route('endangered_animals.show', $animal) }}" class="block bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-xl transition duration-200">
                        <div class="relative w-full h-48">
                            <img src="{{ asset('storage/' . $animal->image_path) }}" alt="{{ $animal->name }}" class="w-full h-full object-cover">
                            
                            {{-- Nama dan Lokasi di Bawah Gambar --}}
                            <div class="absolute inset-x-0 bottom-0 bg-black bg-opacity-60 text-white p-2 text-center">
                                <p class="text-sm font-semibold truncate">{{ $animal->name }}</p>
                                <p class="text-xs text-gray-300">{{ $animal->map->name ?? 'Lokasi Tidak Diketahui' }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-6 text-gray-500 text-center">Data hewan langka belum tersedia.</p>
                @endforelse
            </div>
            </div>
        </div>

        {{-- SECTION 3: LOKASI HEWAN LANGKA DI DUNIA (PETA) --}}
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">
                        Lokasi Hewan Langka di Dunia
                    </h2>
                    <a href="{{ route('map.index') }}" class="text-sm text-gray-600 hover:text-[#38761D] font-semibold">
                        VIEW ALL →
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    @forelse ($maps as $map)
                        <div class="bg-[#D9D9D9] rounded-lg shadow-md overflow-hidden border border-gray-300 p-4 text-center">
                            <img src="{{ asset('storage/' . $map->image_path) }}" alt="{{ $map->name }}" class="w-full h-24 object-contain mb-2">
                            <p class="text-sm font-semibold text-gray-700">{{ $map->name }}</p>
                            <p class="text-xs text-gray-500">{{ $map->description ?? 'Lokasi' }}</p>
                        </div>
                    @empty
                        <p class="col-span-6 text-gray-500 text-center">Data peta belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </body>
</html>
</main>
@endsection