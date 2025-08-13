<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TorneoRequest extends FormRequest
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
            'nombre' => ['bail', 'required', 'max:150'],
            'inscripcion' => ['bail', 'required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'valor_cancha' => ['bail', 'required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'fecha_inicio'=> ['bail', 'required', 'date', 'after_or_equal:today'],
            'fecha_fin'=> ['bail', 'required', 'date', 'after_or_equal:today'],
            'premio'=> ['bail', 'required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'categoria' => ['bail', 'required'],
            'cantidad_equipos'=> ['bail', 'regex:/^[0-9\s]+$/'],
            'premio_extra'=> ['bail', 'regex:/^[0-9-a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:255'],
        ];
    }
}
