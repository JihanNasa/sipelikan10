<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Helper;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // kalau pakai auth bisa disesuaikan
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'youtube_url' => ['required', 'url', function ($attribute, $value, $fail) {
                if (!Helper::getYoutubeId($value)) {
                    $fail('Link YouTube tidak valid.');
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'youtube_url.required' => 'Link YouTube wajib diisi.',
            'youtube_url.url' => 'Format link YouTube tidak valid.',
        ];
    }
}
