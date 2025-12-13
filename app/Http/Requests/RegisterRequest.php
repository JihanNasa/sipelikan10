<?php

namespace App\Http\Requests;

use App\Repositories\SettingRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class RegisterRequest extends FormRequest
{
    /**
     * Tentukan apakah request ini diizinkan.
     */
    public function authorize(): bool
    {
        return (new SettingRepository)->isActiveRegisterPage();
    }

    /**
     * Aturan validasi untuk request register.
     */
    public function rules(): array
    {
        // Jika request berasal dari API
        if (Route::is('api.register')) {
            return [
                'name'          => ['required', 'string', 'max:255', 'unique:users,name'],
                'name2'         => ['required', 'string', 'max:255'],
                'jabatan'       => ['required', 'string'],
                'nib'           => ['required', 'digits:13', 'unique:users,nib'],
                'phone_number'  => ['required', 'string', 'max:20'],
                'address2'      => ['required', 'string'],
                'address'       => ['required', 'string', 'max:255'],
                'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password'      => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8'],
            ];
        }

        // Jika request dari web
        $isGoogleCaptcha = SettingRepository::isGoogleCaptchaRegister();

        return [
            'name'          => ['required', 'string', 'max:255', 'unique:users,name'],
            'name2'         => ['required', 'string', 'max:255'],
            'jabatan'       => ['required', 'string'],
            'nib'           => ['required', 'digits:13', 'unique:users,nib'],
            'phone_number'  => ['required', 'string', 'max:20'],
            'address2'      => ['required', 'string'],
            'address'       => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'g-recaptcha-response'  => $isGoogleCaptcha ? 'required|captcha' : 'nullable',
        ];
    }

    /**
     * Pesan error custom.
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'Nama UPI Tidak Boleh Kosong',
            'name.unique'          => 'Nama UPI Sudah Pernah Digunakan',

            'name2.required'       => 'Nama Penanggung Jawab Tidak Boleh Kosong',

            'jabatan.required'     => 'Jabatan Tidak Boleh Kosong',

            'nib.required'         => 'NIB Tidak Boleh Kosong',
            'nib.digits'           => 'NIB Tidak Sesuai, harus 13 digit angka',
            'nib.unique'           => 'NIB Sudah Pernah Terdaftar',

            'phone_number.required'=> 'No HP Tidak Boleh Kosong',

            'address2.required'    => 'Alamat Kabupaten Tidak Boleh Kosong',

            'address.required'     => 'Alamat Lengkap Perusahaan Tidak Boleh Kosong',

            'email.required'       => 'Email Tidak Boleh Kosong',
            'email.unique'         => 'Email Sudah Pernah Terdaftar',

            'password.required'    => 'Password Harus Di Isi!',
            'password.confirmed'   => 'Konfirmasi Password tidak sesuai',
            'password.min'         => 'Password minimal 8 karakter',

            'password_confirmation.required' => 'Konfirmasi Password wajib diisi.',
            'password_confirmation.min'      => 'Konfirmasi Password minimal 8 karakter.',

            'g-recaptcha-response.required'  => 'Captcha harus diisi.',
            'g-recaptcha-response.captcha'   => 'Captcha tidak valid.',
        ];
    }
}
