<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
// app/Http/Requests/ProfileUpdateRequest.php

    public function rules(): array
    {
        // Coba biarkan hanya aturan yang paling ringan.
        return [
            'name' => ['required', 'string', 'max:255'],
            // Nonaktifkan validasi email yang paling ketat untuk sementara
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'], 
            'social_media' => ['nullable'], 
            'description' => ['nullable'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // File upload
        ];
    }
}
