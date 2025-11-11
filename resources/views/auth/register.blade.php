{{-- resources/views/auth/register.blade.php --}}

<x-guest-layout>
    {{-- Atur background sesuai gambar: abu-abu muda (#f0f0f0) --}}
    <div class="min-h-screen flex items-center justify-center bg-[#f0f0f0] p-4">
        {{-- Card Putih: Kontainer 50/50 --}}
        <div class="flex max-w-4xl w-full bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">

            {{-- Bagian Kiri: Form Sign Up --}}
            <div class="w-full md:w-1/2 p-10">
                <h2 class="text-2xl font-semibold mb-2 text-[#056461]">Sign Up</h2>
                <p class="text-sm text-gray-500 mb-6">Enter your email and password to sign up</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" value="Name" />
                        {{-- Placeholder 'Denis' --}}
                        <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Denis" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" value="Email*" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="mail@anexample.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password" value="Password*" />
                        <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" />
                        <p class="text-xs text-gray-400 mt-1">Min. 8 characters</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password_confirmation" value="Confirm Password*" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    {{-- 'Keep me logged in' dan 'Forgot password?' --}}
                    <div class="flex items-center justify-between mb-6 text-sm">
                        <label for="remember_me" class="flex items-center">
                            {{-- Sesuaikan warna checkbox agar sesuai tema --}}
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-[#056461] shadow-sm focus:ring-[#056461]">
                            <span class="ms-2 text-sm text-gray-600">Keep me logged in</span>
                        </label>

                        <a class="text-sm text-[#056461] hover:underline" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    </div>

                    {{-- Tombol Sign Up (Warna Teal Gelap) --}}
                    <button type="submit" class="w-full bg-[#056461] hover:bg-[#04504E] text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        Sign Up
                    </button>

                    {{-- resources/views/auth/login.blade.php / register.blade.php --}}

                    <div class="mt-4">
                        <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center space-x-2 bg-white border border-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md shadow-sm hover:bg-gray-50 transition duration-150">
                            <svg class="h-5 w-5" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 10.15v5.82h12.78c-.58 3.53-2.61 6.86-5.8 8.9v5.6c4.66-2.58 8-7.7 8-13.92 0-9.45-7.66-17.1-17-17.1-9.37 0-17 7.65-17 17.1s7.63 17.1 17 17.1c4.5 0 8.52-1.78 11.58-4.9l-4.1-4.1c-1.8 1.58-4.25 2.5-7.48 2.5-5.3 0-9.62-4.32-9.62-9.62s4.32-9.63 9.62-9.63c2.75 0 4.9.96 6.56 2.45l4.08-4.08C32.52 11.63 28.5 10.15 24 10.15z"/>
                            </svg>
                            <span>Login with Google</span>
                        </a>
                    </div>

                    <div class="mt-6 text-center text-sm">
                        Already have an account?
                        <a class="text-[#056461] hover:underline font-medium" href="{{ route('login') }}">
                            Log In here
                        </a>
                    </div>
                </form>
            </div>

            {{-- Bagian Kanan: Logo NexTerra (Gunakan gambar yang sama dengan yang Anda unggah) --}}
            <div class="hidden md:flex md:w-1/2 bg-white items-center justify-center p-8 border-l border-gray-200">
                {{-- Ganti dengan tag gambar logo yang Anda simpan di public/images/ --}}
                <img src="{{ asset('images/nexterra-logo.png') }}" alt="Nexterra Logo" class="max-w-full h-auto">
                {{-- Jika Anda hanya menggunakan teks dan gambar SVG/Dinosaurus yang terpisah: --}}
                {{-- <div class="text-center">
                     
                    <h1 class="text-5xl font-bold mt-4" style="color:#2D572C;">nexTerra</h1>
                </div> --}}
            </div>
        </div>
    </div>
</x-guest-layout>