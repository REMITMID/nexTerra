
<x-app-layout>
    <x-slot name="header"></x-slot>
    <div class="min-h-screen bg-gray-100">
        {{-- Header / Hero Section --}}


        {{-- Konten Utama Profil --}}
        <div class="max-w-4xl mx-auto -mt-24 p-4">
            <div class="bg-white rounded-lg shadow-xl p-8 text-center border border-gray-200">
                
                {{-- Foto Profil --}}
                <div class="mx-auto h-40 w-40 rounded-full bg-gray-300 mb-6 flex items-center justify-center overflow-hidden border-4 border-white">
                    @if ($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                    @else
                        {{-- Placeholder --}}
                        <svg class="h-20 w-20 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112 18.014a14.977 14.977 0 0112 2.979zM12 14A6 6 0 1012 2a6 6 0 000 12z"/>
                        </svg>
                    @endif
                </div>

                {{-- Nama dan Email --}}
                <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $user->name }}</h2>
                <p class="text-gray-500 mb-6">{{ $user->email }}</p>

                {{-- Deskripsi Diri --}}
                <div class="max-w-2xl mx-auto mb-8 text-center text-gray-700">
                    <p>{{ $user->description ?? 'Deskripsi diri belum ditambahkan.' }}</p>
                </div>
                
                {{-- Media Sosial --}}
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Media Sosial:</h3>
                    <p class="text-gray-600">{{ $user->social_media ?? 'Tidak ada tautan media sosial.' }}</p>
                </div>

                {{-- Tombol Update --}}
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center bg-[#6AA84F] hover:bg-[#5C9041] text-white font-bold py-2 px-6 rounded-lg transition duration-150">
                    Update Profile
                    <svg class="h-5 w-5 ms-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11 3a1 1 0 100 2h3.586l-7.793 7.793a1 1 0 001.414 1.414L16 6.414V10a1 1 0 102 0V3a1 1 0 00-1-1h-7z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M11 16a1 1 0 100 2h7a1 1 0 001-1v-7a1 1 0 10-2 0v5.586l-7.793-7.793a1 1 0 00-1.414 1.414L15.586 16H11z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
