<section>
    <div class="bg-[#38761D] p-10 rounded-lg shadow-xl text-white max-w-lg mx-auto">
        <header class="text-center mb-8">
            <h2 class="text-2xl font-bold text-white">
                PROFIL PENGGUNA
            </h2>
            <p class="mt-1 text-sm text-gray-300">
                Update information
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('patch')

            {{-- FOTO PROFIL --}}
            <div class="text-center mb-6">
                <div class="mx-auto h-32 w-32 rounded-full bg-gray-300 mb-4 flex items-center justify-center overflow-hidden border-2 border-white">
                    @if ($user->profile_photo_path)
                        <img id="current_photo" src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                    @else
                        <svg class="h-16 w-16 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112 18.014a14.977 14.977 0 0112 2.979zM12 14A6 6 0 1012 2a6 6 0 000 12z"/>
                        </svg>
                    @endif
                </div>
                <label for="profile_photo" class="text-sm font-medium">Foto Profil</label>
                <input type="file" id="profile_photo" name="profile_photo" class="w-full p-2 rounded bg-gray-700 border border-gray-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#6AA84F] file:text-white hover:file:bg-[#5C9041]">
                @error('profile_photo') <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span> @enderror
            </div>
            
            {{-- NAMA PENGGUNA --}}
            <div>
                <x-input-label for="name" value="Nama Pengguna" class="text-sm font-medium" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- MEDIA SOSIAL --}}
            <div>
                <x-input-label for="social_media" value="Media Sosial" class="text-sm font-medium" />
                <x-text-input id="social_media" name="social_media" type="text" class="mt-1 block w-full bg-gray-700 border-gray-600 text-white" :value="old('social_media', $user->social_media)" autocomplete="social_media" placeholder="raynor_gaspol" />
                <x-input-error class="mt-2" :messages="$errors->get('social_media')" />
            </div>

            {{-- DESKRIPSI DIRI --}}
            <div>
                <x-input-label for="description" value="Deskripsi Diri" class="text-sm font-medium" />
                <textarea id="description" name="description" rows="5" class="mt-1 block w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring focus:ring-gray-500 text-white">{{ old('description', $user->description) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            {{-- Email (opsional, karena Breeze memisahkannya) --}}
            {{-- Anda bisa memindahkannya ke sini jika ingin --}}
            
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('profile.view') }}" class="bg-[#B03C36] hover:bg-[#97332E] text-white font-bold py-2 px-6 rounded transition duration-150">Batal</a>
                <button type="submit" class="bg-[#6AA84F] hover:bg-[#5C9041] text-white font-bold py-2 px-6 rounded transition duration-150">Update</button>
            </div>
        </form>
    </div>
</section>