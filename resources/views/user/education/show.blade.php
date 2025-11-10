{{-- resources/views/user/education/show.blade.php --}}

@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-gray-100 pb-12">
        
        {{-- Hero Header --}}
        <div class="relative h-[50vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute top-4 left-4">
                <a href="{{ route('education.index') }}" class="text-white bg-black bg-opacity-50 p-2 rounded-full hover:bg-opacity-70 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8m-7 1V4a1 1 0 011-1h6a1 1 0 011 1v16a1 1 0 01-1 1H7a1 1 0 01-1-1z" /></svg>
                </a>
            </div>
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    APA YANG DIMAKSUD HEWAN LANGKA?
                </h1>
                <p class="mt-2 text-lg">MARI KITA DISKUSIKAN HEWAN LANGKAH</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                {{ $item->title }}
            </h2>
            
            {{-- Foto Utama (Jika ada) --}}
            @if ($item->image_path)
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full max-h-96 object-contain mb-8 rounded-lg mx-auto shadow-md">
            @endif

            <div class="bg-white rounded-lg shadow-xl p-6 border border-gray-200">
                
                {{-- Konten Edukasi --}}
                <div class="text-gray-700 leading-relaxed">
                    <h3 class="text-2xl font-bold mb-4">Apa Itu {{ $item->title }}?</h3>
                    <p class="mb-4">
                        {{ $item->content }}
                    </p>
                    
                    {{-- Informasi Klasifikasi Tambahan (Contoh Statis) --}}
                    <h4 class="text-xl font-semibold mt-6 mb-3">Klasifikasi Konservasi:</h4>
                    <ul class="list-disc list-inside space-y-1 ml-4">
                        <li>**Critically Endangered (Kritis):** Risiko kepunahan sangat tinggi, contohnya badak Jawa.</li>
                        <li>**Endangered (Tergancam):** Populasi menurun drastis, seperti orangutan Sumatera.</li>
                        <li>**Vulnerable (Rentan):** Berisiko menjadi terancam jika tidak dilindungi, seperti komodo.</li>
                    </ul>
                    
                    <h4 class="text-xl font-semibold mt-8 mb-3">Penyebab Kelangkaan Hewan?</h4>
                    <ul class="list-disc list-inside space-y-3 text-sm ml-4">
                        <li>**Kehilangan Habitat:** Deforestasi, urbanisasi, dan konversi lahan untuk pertanian atau industri mengurangi tempat tinggal alami hewan.</li>
                        <li>**Perburuan dan Perdagangan Ilegal:** Banyak hewan diburu untuk diambil bagian tubuhnya (gading, kulit, atau cula) atau untuk perdagangan hewan peliharaan.</li>
                        <li>**Perubahan Iklim:** Perubahan suhu dan pola cuaca memengaruhi siklus hidup hewan, seperti penyu yang bergantung pada suhu pasir untuk penetasan telur.</li>
                        <li>**Polusi:** Pencemaran air, udara, dan tanah mengganggu ekosistem hewan, misalnya polusi laut yang membahayakan terumbu karang dan biota laut.</li>
                        <li>**Spesies Invasif:** Spesies asing yang diperkenalkan ke suatu ekosistem dapat mengganggu keseimbangan, seperti tikus yang mengancam burung endemik di pulau-pulau kecil.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection