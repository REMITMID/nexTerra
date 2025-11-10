<x-guest-layout>
    <div class="min-h-screen bg-gray-100 pb-12">
        
        {{-- Hero Header --}}
        <div class="relative h-[40vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute top-4 left-4">
                <a href="{{ route('news.index') }}" class="text-white bg-black bg-opacity-50 p-2 rounded-full hover:bg-opacity-70 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8m-7 1V4a1 1 0 011-1h6a1 1 0 011 1v16a1 1 0 01-1 1H7a1 1 0 01-1-1z" /></svg>
                </a>
            </div>
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    Jangan Sampai Ketinggalan!
                </h1>
                <p class="mt-2 text-lg">Berita dan Informasi Terbaru</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                {{ $item->title }}
            </h2>

            <div class="bg-white rounded-lg shadow-xl p-6 border border-gray-200">
                
                {{-- Poster --}}
                @if ($item->poster_path)
                    <img src="{{ asset('storage/' . $item->poster_path) }}" alt="{{ $item->title }}" class="w-full max-h-96 object-contain mb-6 rounded-lg mx-auto">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center mb-6 rounded-lg">
                        <span class="text-gray-500 text-lg">Poster Tidak Tersedia</span>
                    </div>
                @endif

                {{-- Konten Berita --}}
                <div class="text-gray-700 leading-relaxed text-center mb-8">
                    {{ $item->description }}
                </div>
                
                {{-- Call to Action (CTA) --}}
                <div class="text-center font-semibold text-lg text-gray-800 italic border-t pt-4">
                    "Bantu kami jaga keberlangsungan hidup satwa langka dengan donasi Anda, sekecil apapun itu berarti besar!"
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>