<?php

namespace App\Http\Requests;

use App\Models\Pin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // board harus milik user yang sedang login
            'board_id' => ['required', Rule::exists('boards', 'id')->where('user_id', $this->user()->id)],
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image_url' => ['required', 'url:http,https', 'max:2048'],
            'category' => ['nullable', Rule::in(Pin::CATEGORIES)],
        ];
    }
}