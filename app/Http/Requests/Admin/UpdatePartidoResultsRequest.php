<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartidoResultsRequest extends FormRequest
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
            'goles_local' => ['nullable', 'integer', 'min:0'],
            'goles_visitante' => ['nullable', 'integer', 'min:0'],
            'estado' => ['required', 'string', 'in:programado,finalizado,suspendido,cancelado'],
        ];
    }

     /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'goles_local.integer' => 'Los goles del equipo local deben ser un número entero.',
            'goles_local.min' => 'Los goles del equipo local no pueden ser negativos.',
            'goles_visitante.integer' => 'Los goles del equipo visitante deben ser un número entero.',
            'goles_visitante.min' => 'Los goles del equipo visitante no pueden ser negativos.',
            'estado.required' => 'El estado del partido es obligatorio.',
            'estado.in' => 'El estado del partido seleccionado no es válido.',
        ];
    }
}
