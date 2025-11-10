<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

<div class="flex items-center justify-center min-h-screen w-full"> 
        
        <div class="w-full sm:px-6 lg:px-8 space-y-6 flex flex-col items-center justify-center">
            
            {{-- Kotak Update Profile --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-xl">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            
            {{-- Kotak Update Password (Tambahkan w-full max-w-xl jika ingin di tengah) --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-xl">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Kotak Delete User (Tambahkan w-full max-w-xl jika ingin di tengah) --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full max-w-xl">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>