<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class EquipoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file_uri' => [
                'bail',
                'nullable',
                File::image()->max(10 * 1024)->dimensions(Rule::dimensions()
                    ->maxWidth(650)->maxHeight(650)) // esta regla valida el formato de imagen y el tamaño máximo
            ], 
            'nombre'=> [
                'bail',
                'required',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'torneo_id' => [
                'bail',
                'required',
                'exists:torneos,id'
            ]
        ];
    }
}
