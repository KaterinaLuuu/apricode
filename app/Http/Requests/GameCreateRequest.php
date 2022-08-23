<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title'  => 'required|string',
            'studio' => 'required|string',
            'genres' => 'required|array',
        ];
    }
}
