<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'     => 'filled|string',
            'studio'    => 'filled|string',
            'genres'    => 'filled|array',
        ];
    }
}
