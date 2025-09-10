<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JugadorRequest extends FormRequest
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
        // Determinar si es para actualización (tiene parámetro jugador en la ruta)
        $isUpdating = $this->route('jugador') !== null;
        $jugadorId = $isUpdating ? $this->route('jugador')->id : null;
        
        $rules = [
            'equipo_id' => ['required', 'exists:equipos,id'],
        ];

        if ($isUpdating) {
            // Reglas para actualización individual
            $rules['posicion'] = ['nullable', 'string', 'in:POR,DFC,LD,LI,MCD,MC,MCO,ED,EI,SP,DC'];
            $rules['num_camiseta'] = [
                'nullable', 
                'integer', 
                'min:1', 
                'max:99',
                // Validación personalizada para número de camiseta único en el equipo
                function ($attribute, $value, $fail) use ($jugadorId) {
                    if ($value) {
                        $equipoId = $this->input('equipo_id');
                        $exists = \DB::table('equipo_user')
                            ->where('equipo_id', $equipoId)
                            ->where('num_camiseta', $value)
                            ->where('user_id', '!=', $jugadorId)
                            ->exists();
                        
                        if ($exists) {
                            $fail('El número de camiseta ya está en uso en este equipo.');
                        }
                    }
                }
            ];
        } else {
            // Reglas para creación múltiple
            $rules['jugadores'] = ['array'];
            $rules['jugadores.*.user_id'] = ['required', 'exists:users,id'];
            $rules['jugadores.*.num_camiseta'] = ['nullable', 'integer', 'min:1', 'max:99'];
            $rules['jugadores.*.posicion'] = ['nullable', 'string', 'in:POR,DFC,LD,LI,MCD,MC,MCO,ED,EI,SP,DC'];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'equipo_id.required' => 'Debe seleccionar un equipo.',
            'equipo_id.exists' => 'El equipo seleccionado no existe.',
            'num_camiseta.integer' => 'El número de camiseta debe ser un número.',
            'num_camiseta.min' => 'El número de camiseta debe ser mayor a 0.',
            'num_camiseta.max' => 'El número de camiseta debe ser menor a 100.',
            'posicion.in' => 'La posición seleccionada no es válida.',
            'jugadores.*.user_id.required' => 'Debe seleccionar un jugador válido.',
            'jugadores.*.user_id.exists' => 'El jugador seleccionado no existe.',
            'jugadores.*.num_camiseta.integer' => 'El número de camiseta debe ser un número.',
            'jugadores.*.num_camiseta.min' => 'El número de camiseta debe ser mayor a 0.',
            'jugadores.*.num_camiseta.max' => 'El número de camiseta debe ser menor a 100.',
            'jugadores.*.posicion.in' => 'La posición seleccionada no es válida.',
        ];
    }
}
