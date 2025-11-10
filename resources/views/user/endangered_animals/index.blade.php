{{-- resources/views/user/endangered_animals/index.blade.php --}}

@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-[#f5f5f5] pb-12">
        
        {{-- Hero Header --}}
        <div class="relative h-[50vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    Mengenal Hewan Langka di Dunia
                </h1>
                <p class="mt-2 text-lg">Jelajahi keunikan hewan langka dari berbagai belahan dunia.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative">
            
            {{-- Search Bar --}}
            <div class="mb-12 flex items-center bg-white shadow-lg p-4 rounded-lg border border-gray-200 max-w-lg mx-auto">
                <input type="text" placeholder="Telusuri Hewan..." class="w-full p-2 border-0 focus:ring-0 focus:outline-none text-lg">
                <button class="bg-[#38761D] text-white p-2 rounded-lg hover:bg-[#4A902C] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Grid Daftar Hewan Langka --}}
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
@endsection