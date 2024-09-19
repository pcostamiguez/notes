<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:10|max:50',
            'body' => 'required|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório',
            'title.min' => 'O título deve ter no mínimo :min caracteres',
            'title.max' => 'O título deve ter no máximo :max caracteres',
            'body.required' => 'A mensagem é obrigatória',
            'body.min' => 'A mensagem deve ter no mínimo :min caracteres',
        ];
    }
}
