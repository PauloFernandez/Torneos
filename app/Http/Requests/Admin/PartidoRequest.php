<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartidoRequest extends FormRequest
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
            'arbitro_id' => ['required','exists:arbitros,id'],
            'cancha_id' => ['required','exists:canchas,id'],
            'fecha' => ['required','date'],
            'hora' => ['required'],
            'torneo_id' => ['required','exists:torneos,id'],
            'equipo_local_id' => ['required','exists:equipos,id'],
            'goles_local' => ['nullable','integer','min:0'],
            'equipo_visitante_id' => ['required','exists:equipos,id','different:equipo_local_id'],
            'goles_visitante' => ['nullable','integer','min:0'],
        ];
    }
}
