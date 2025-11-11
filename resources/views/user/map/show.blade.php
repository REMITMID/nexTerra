@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-[#f5f5f5] pb-12">
        
        {{-- Hero Header --}}
        <div class="relative h-[40vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute top-4 left-4">
                <a href="{{ route('map.index') }}" class="text-white bg-black bg-opacity-50 p-2 rounded-full hover:bg-opacity-70 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8m-7 1V4a1 1 0 011-1h6a1 1 0 011 1v16a1 1 0 01-1 1H7a1 1 0 01-1-1z" /></svg>
                </a>
            </div>
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    Mengetahui Lokasi Hewan Langka
                </h1>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            {{-- Detail Peta (Kotak Utama) --}}
            <div class="bg-white rounded-lg shadow-xl p-6 border border-gray-200 mb-12 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $map->name }}</h1>

                {{-- Gambar Peta --}}
                @if ($map->image_path)
                    <img src="{{ asset('storage/' . $map->image_path) }}" alt="Peta {{ $map->name }}" class="w-full max-h-96 object-contain mb-8 rounded-lg mx-auto shadow-md">
                @endif

                {{-- Deskripsi Peta/Lokasi --}}
                <div class="text-gray-700 leading-relaxed text-left max-w-3xl mx-auto">
                    @if ($map->description)
                        <p class="mb-4">{{ $map->description }}</p>
                    @else
                        <p class="mb-4">Informasi tentang lokasi ini belum tersedia.</p>
                    @endif
                    <p class="mt-4 font-semibold">Secara ringkas, hewan-hewan langka di {{ $map->name }} mewakili perjuangan untuk menjaga keseimbangan antara pembangunan dan pertanian modern dengan pelestarian keanekaragaman hayati lokal yang tersisa.</p>
                </div>
            </div>

            {{-- Daftar Hewan Langka di Lokasi Ini --}}
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Hewan Langka:</h2>
            
            @if ($animals->isEmpty())
                <p class="text-gray-600">Saat ini belum ada data hewan langka yang terdaftar di lokasi {{ $map->name }}.</p>
            @else
                <div class="flex flex-wrap gap-4 justify-center">
                    @foreach ($animals as $animal)
                        <a href="{{ route('endangered_animals.show', $animal) }}" class="block w-40 bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-xl transition duration-200">
                            <div class="relative w-full h-32">
                                <img src="{{ asset('storage/' . $animal->image_path) }}" alt="{{ $animal->name }}" class="w-full h-full object-cover">
                                <div class="absolute inset-x-0 bottom-0 bg-black bg-opacity-60 text-white p-1 text-center">
                                    <p class="text-xs font-semibold truncate">{{ $animal->name }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection