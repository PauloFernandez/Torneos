<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DetallePartidoRequest extends FormRequest
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
            'jugadores_seleccionados' => 'required|array|min:1',
            'jugadores_seleccionados.*' => 'exists:users,id',
            'jugadores' => 'nullable|array',
            'jugadores.*.jugador_id' => 'required|exists:users,id',
            'jugadores.*.equipo_id' => 'required|exists:equipos,id',
            'jugadores.*.goles' => 'nullable|integer|min:0|max:20',
            'jugadores.*.asistencias' => 'nullable|integer|min:0|max:20',
            'jugadores.*.tarjetas_amarillas' => 'nullable|integer|min:0|max:2',
            'jugadores.*.tarjetas_rojas' => 'nullable|integer|min:0|max:1',
            'jugadores.*.tipo_participacion' => 'required|in:titular,suplente',
        ];
    }

    public function messages(): array
    {
        return [
            'jugadores_seleccionados.required' => 'Debes seleccionar al menos un jugador.',
            'jugadores_seleccionados.min' => 'Debes seleccionar al menos un jugador.',
            'jugadores.*.goles.integer' => 'Los goles deben ser un número entero.',
            'jugadores.*.goles.min' => 'Los goles no pueden ser negativos.',
            'jugadores.*.goles.max' => 'Los goles no pueden ser mayores a 20.',
            'jugadores.*.asistencias.integer' => 'Las asistencias deben ser un número entero.',
            'jugadores.*.asistencias.min' => 'Las asistencias no pueden ser negativas.',
            'jugadores.*.asistencias.max' => 'Las asistencias no pueden ser mayores a 20.',
            'jugadores.*.tarjetas_amarillas.integer' => 'Las tarjetas amarillas deben ser un número entero.',
            'jugadores.*.tarjetas_amarillas.min' => 'Las tarjetas amarillas no pueden ser negativas.',
            'jugadores.*.tarjetas_amarillas.max' => 'Las tarjetas amarillas no pueden ser mayores a 2.',
            'jugadores.*.tarjetas_rojas.integer' => 'Las tarjetas rojas deben ser un número entero.',
            'jugadores.*.tarjetas_rojas.min' => 'Las tarjetas rojas no pueden ser negativas.',
            'jugadores.*.tarjetas_rojas.max' => 'Las tarjetas rojas no pueden ser mayores a 1.',
            'jugadores.*.tipo_participacion.required' => 'El tipo de participación es obligatorio.',
            'jugadores.*.tipo_participacion.in' => 'El tipo de participación debe ser "titular" o "suplente".',
        ];
    }
}
