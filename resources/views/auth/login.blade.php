{{-- resources/views/auth/login.blade.php --}}

<x-guest-layout>
    {{-- Atur background sesuai gambar: abu-abu muda (#f0f0f0) --}}
    <div class="min-h-screen flex items-center justify-center bg-[#f0f0f0] p-4">
        {{-- Card Putih: Kontainer 50/50 --}}
        <div class="flex max-w-4xl w-full bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
            
            {{-- Bagian Kiri: Form Log In --}}
            <div class="w-full md:w-1/2 p-10">
                <h2 class="text-2xl font-semibold mb-2 text-[#056461]">Log In</h2>
                <p class="text-sm text-gray-500 mb-6">Enter your email and password to log in</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="email" value="Email*" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="mail@anexample.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password" value="Password*" />
                        <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
                        <p class="text-xs text-gray-400 mt-1">Min. 8 characters</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- 'Keep me logged in' dan 'Forgot password?' --}}
                    <div class="flex items-center justify-between mb-6 text-sm">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-[#056461] shadow-sm focus:ring-[#056461]">
                            <span class="ms-2 text-sm text-gray-600">Keep me logged in</span>
                        </label>

                        <a class="text-sm text-gray-600 hover:text-gray-900 underline" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    </div>

                    {{-- Tombol Log In (Warna Teal Gelap) --}}
                    <button type="submit" class="w-full bg-[#056461] hover:bg-[#04504E] text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        Log In
                    </button>

                    <div class="mt-4">
                        <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center space-x-2 bg-white border border-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md shadow-sm hover:bg-gray-50 transition duration-150">
                            <svg class="h-5 w-5" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 10.15v5.82h12.78c-.58 3.53-2.61 6.86-5.8 8.9v5.6c4.66-2.58 8-7.7 8-13.92 0-9.45-7.66-17.1-17-17.1-9.37 0-17 7.65-17 17.1s7.63 17.1 17 17.1c4.5 0 8.52-1.78 11.58-4.9l-4.1-4.1c-1.8 1.58-4.25 2.5-7.48 2.5-5.3 0-9.62-4.32-9.62-9.62s4.32-9.63 9.62-9.63c2.75 0 4.9.96 6.56 2.45l4.08-4.08C32.52 11.63 28.5 10.15 24 10.15z"/>
                            </svg>
                            <span>Login with Google</span>
                        </a>
                    </div>

                    <div class="mt-6 text-center text-sm">
                        Don't have an account?
                        <a class="text-[#056461] hover:underline font-medium" href="{{ route('register') }}">
                            Sign up here
                        </a>
                    </div>
                </form>
            </div>

            {{-- Bagian Kanan: Logo NexTerra --}}
            <div class="hidden md:flex md:w-1/2 bg-white items-center justify-center p-8 border-l border-gray-200">
                {{-- Ganti dengan tag gambar logo yang Anda simpan di public/images/ --}}
                <img src="{{ asset('images/nexterra-logo.png') }}" alt="Nexterra Logo" class="max-w-full h-auto">
            </div>
        </div>
    </div>
</x-guest-layout>