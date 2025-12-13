<?php

namespace App\Http\Requests;

use App\Repositories\SettingRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Tentukan apakah user berhak menggunakan request ini
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // biar semua user bisa akses reset password
    }

    /**
     * Rules validasi untuk reset password
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',      // huruf kecil
                'regex:/[A-Z]/',      // huruf besar
                'regex:/[0-9]/',      // angka
                'regex:/[@$!%*?&]/',  // karakter spesial
                'confirmed',          // harus sama dengan password_confirmation
            ],
        ];
    }

    /**
     * Pesan error custom untuk validasi
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required'   => 'Password wajib diisi',
            'password.min'        => 'Password minimal 8 karakter',
            'password.regex'      => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter spesial (@$!%*?&)',
            'password.confirmed'  => 'Konfirmasi password tidak cocok',
        ];
    }
}