@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-gray-100 pb-12">
        
        {{-- Hero Header (Sama seperti Beranda) --}}
        <div class="relative h-[60vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    Jangan Sampai Ketinggalan!
                </h1>
                <p class="mt-2 text-lg">Berita dan Informasi Terbaru</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative">
            
            {{-- Search Bar --}}
            <div class="mb-8 flex items-center bg-white shadow-lg p-4 rounded-lg border border-gray-200 max-w-lg mx-auto">
                <input type="text" placeholder="Telusuri" class="w-full p-2 border-0 focus:ring-0 focus:outline-none text-lg">
                <button class="bg-[#38761D] text-white p-2 rounded-lg hover:bg-[#4A902C] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            {{-- Grid Daftar Berita --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
                @forelse ($news_items as $item)
                    {{-- ... (lanjutan grid item) ... --}}
                    <div class="bg-white rounded-lg shadow-xl overflow-hidden border border-gray-200 flex flex-col items-center text-center">
                        {{-- Poster Berita --}}
                        @if ($item->poster_path)
                             <img src="{{ asset('storage/' . $item->poster_path) }}" alt="{{ $item->title }}" class="w-full h-80 object-cover">
                        @else
                            <div class="w-full h-80 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500 text-sm">No Poster Available</span>
                            </div>
                        @endif
                        
                        <div class="p-4 flex flex-col justify-between h-full">
                            <h3 class="font-bold text-lg text-gray-800 mb-4">{{ $item->title }}</h3>
                            {{-- Tombol Detail --}}
                            <a href="{{ route('news.show', $item) }}" class="block w-full text-center bg-[#6AA84F] hover:bg-[#5C9041] text-white font-bold py-2 px-4 rounded transition duration-150 mt-auto">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-gray-500 text-center">Saat ini belum ada berita terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection