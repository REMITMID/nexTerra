{{-- resources/views/user/endangered_animals/show.blade.php --}}

@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-[#f5f5f5] pb-12">
        
        {{-- Hero Header --}}
        <div class="relative h-[40vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute top-4 left-4">
                <a href="{{ route('endangered_animals.index') }}" class="text-white bg-black bg-opacity-50 p-2 rounded-full hover:bg-opacity-70 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8m-7 1V4a1 1 0 011-1h6a1 1 0 011 1v16a1 1 0 01-1 1H7a1 1 0 01-1-1z" /></svg>
                </a>
            </div>
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    Mengenal Hewan Langka di Dunia
                </h1>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                {{ $animal->name }}
            </h2>

            <div class="bg-white rounded-lg shadow-xl p-6 border border-gray-200">
                
                {{-- Foto Hewan --}}
                <img src="{{ asset('storage/' . $animal->image_path) }}" alt="{{ $animal->name }}" class="w-full max-h-96 object-contain mb-8 rounded-lg mx-auto shadow-md">

                {{-- Konten Deskripsi --}}
                <div class="text-gray-700 leading-relaxed mb-8">
                    <h3 class="text-xl font-semibold mb-3">Deskripsi Umum</h3>
                    <p class="mb-4">{{ $animal->description }}</p>
                </div>
                
                {{-- Habitat dan Populasi --}}
                <div class="text-gray-700 leading-relaxed mb-8">
                    <h3 class="text-xl font-semibold mb-3">Habitat dan Populasi</h3>
                    <p class="mb-2">Asal Lokasi: **{{ $animal->map->name ?? 'Global' }}**</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>Populasi: Berkurang drastis. Tinggal di hutan tropis.</li>
                        <li>Ancaman utama: Deforestasi dan perburuan liar.</li>
                    </ul>
                </div>
                
                {{-- Upaya Konservasi --}}
                <div class="text-gray-700 leading-relaxed">
                    <h3 class="text-xl font-semibold mb-3">Upaya Konservasi</h3>
                    <p class="mb-2">Karena sifatnya yang pemalu dan sulit didiami, upaya konservasi {{ $animal->name }} sangat seringkali fokus pada perlindungan habitat.</p>
                    <ul class="list-disc list-inside space-y-2 ml-4">
                        <li>**Perlindungan Kawasan Hutan:** Memastikan wilayah hutan yang menjadi habitatnya di {{ $animal->map->name ?? 'lokasi asal' }} terlindungi.</li>
                        <li>**Edukasi Publik:** Mengedukasi masyarakat tentang pentingnya menjaga satwa langka.</li>
                    </ul>
                </div>

                <div class="text-center mt-8 pt-4 border-t">
                    <p class="font-bold text-[#38761D] italic">
                        "Bantu kami jaga keberlangsungan hidup satwa langka dengan donasi Anda, sekecil apapun itu berarti besar!"
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection