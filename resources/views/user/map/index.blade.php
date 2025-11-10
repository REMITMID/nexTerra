@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-[#f5f5f5] pb-12">
        
        {{-- Hero Header --}}
        <div class="relative h-[40vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    JELAJAHI LOKASI HEWAN LANGKA
                </h1>
                <p class="mt-2 text-lg">Temukan lokasi habitat di seluruh dunia.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative">
            
            {{-- Search Bar --}}
            <div class="mb-12 flex items-center bg-white shadow-lg p-4 rounded-lg border border-gray-200 max-w-lg mx-auto">
                <input type="text" placeholder="Telusuri Peta..." class="w-full p-2 border-0 focus:ring-0 focus:outline-none text-lg">
                <button class="bg-[#38761D] text-white p-2 rounded-lg hover:bg-[#4A902C] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Grid Daftar Peta --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @forelse ($maps as $map)
                    {{-- Item Peta --}}
                    <a href="{{ route('map.show', $map) }}" class="block bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 p-4 text-center hover:shadow-xl transition duration-200">
                        {{-- Tampilkan Gambar Peta --}}
                        @if ($map->image_path)
                             <img src="{{ asset('storage/' . $map->image_path) }}" alt="{{ $map->name }}" class="w-full h-32 object-contain mb-3 rounded">
                        @else
                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center mb-3 rounded">
                                <span class="text-gray-500 text-sm">No Map Image</span>
                            </div>
                        @endif
                        
                        <h3 class="font-bold text-lg text-gray-800 mt-2">{{ $map->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $map->description ?? 'Lokasi' }}</p>
                    </a>
                @empty
                    <p class="col-span-6 text-gray-500 text-center">Belum ada data Peta/Lokasi yang dibuat.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection