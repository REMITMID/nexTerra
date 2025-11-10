{{-- resources/views/user/forum/index.blade.php --}}

@extends('layouts.public')

@section('content')
    <div class="min-h-screen bg-[#f5f5f5] pb-12">
        
        {{-- Hero Header --}}
        <div class="relative h-[40vh] bg-cover bg-center" style="background-image: url('{{ asset('images/hero_background.png') }}');">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-center text-white p-4">
                <h1 class="text-4xl md:text-5xl font-bold text-center">
                    Forum Diskusi
                </h1>
                <p class="mt-2 text-lg">MARI KITA DISKUSIKAN TERKAIT HEWAN LANGKA</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            {{-- Form Postingan Baru (Hanya tampil jika user login) --}}
            @auth
            <div class="bg-white p-6 rounded-lg shadow-xl mb-8 border border-gray-200">
                <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
                    @csrf
                    
                    <div class="flex items-end space-x-2">
                        {{-- Input Text --}}
                        <input type="text" name="content" placeholder="Tulis komentar atau pertanyaan..." class="w-full p-3 rounded-lg border border-gray-300 focus:ring-[#38761D] focus:border-[#38761D]">
                        
                        {{-- Input File (Hidden) --}}
                        <label for="image_upload" class="bg-[#38761D] text-white p-3 rounded-lg hover:bg-[#4A902C] transition cursor-pointer">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.218A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.218A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <input type="file" id="image_upload" name="image" class="hidden">
                        </label>
                        
                        {{-- Tombol Kirim --}}
                        <button type="submit" class="bg-[#38761D] text-white p-3 rounded-lg hover:bg-[#4A902C] transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </div>
                    @error('content') <span class="text-red-500 text-sm mt-1">Isi konten wajib diisi.</span> @enderror
                    @error('image') <span class="text-red-500 text-sm mt-1">Format gambar tidak valid atau terlalu besar.</span> @enderror
                </form>
            </div>
            @else
                <p class="text-center text-gray-600 mb-6">Silakan <a href="{{ route('login') }}" class="text-[#38761D] underline">login</a> untuk memposting diskusi.</p>
            @endauth

            {{-- Feed Diskusi --}}
            <div class="space-y-4">
                @forelse ($discussions as $discussion)
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <div class="flex items-start space-x-4 mb-4">
                            {{-- Avatar/Warna User --}}
                            <div class="h-8 w-8 rounded-full flex-shrink-0" style="background-color: {{ ['#FFEB3B', '#FF8A80', '#00BCD4', '#E040FB', '#BDBDBD'][($discussion->user->id ?? 0) % 5] }}"></div>
                            
                            <div>
                                <p class="font-semibold text-gray-800">{{ $discussion->user->name ?? 'User Dihapus' }}</p>
                                <p class="text-sm text-gray-500">{{ $discussion->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        {{-- Konten Diskusi --}}
                        <p class="text-gray-700 mb-4">{{ $discussion->content }}</p>
                        
                        {{-- Gambar Postingan --}}
                        @if ($discussion->image_path)
                            <img src="{{ asset('storage/' . $discussion->image_path) }}" alt="Gambar Postingan" class="max-w-xs rounded-lg shadow-sm mb-4">
                        @endif

                        {{-- Tombol Interaksi (Sederhana) --}}
                        <button class="text-sm text-blue-600 hover:underline">Reply</button>
                    </div>
                @empty
                    <p class="text-center text-gray-600">Belum ada diskusi. Jadilah yang pertama!</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection