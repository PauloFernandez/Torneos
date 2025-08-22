<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArbitrosRequest extends FormRequest
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
            'documento' => [
                'bail',
                'required',
                'regex:/^[0-9\s]+$/', // 'regex' esta regla valida los caracteres permitidos en este caso acepta solo numeros
                'min:8',
                'max:8',
                Rule::unique('arbitros')->ignore($this->route('arbitro')) // Rule::unique valida que el campo sea unico, el 'ignore' sirve para cuando se esta editando
            ],
            'nombre' => [
                'bail',
                'required',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/' // 'regex' esta regla valida los caracteres permitidos en este caso no acepta numeros
            ],
            'apellido' => [
                'bail', 
                'required', 
                'max:50', 
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'fecha_nac' => [
                'bail',
                'required',
                'date',
                'before:' . now()->subYears(18)->format('Y-m-d'), // 'before' valida que la fecha sea anterior a "xx" años desde hoy, con la instruccion now()->subYears() indicamos la cantidad de años
                'after:' . now()->subYears(95)->format('Y-m-d')
            ],
            'telefono' => [
                'bail',
                'required',
                'regex:/^[0-9\s]+$/',
                'min:8',
                'max:9',
                Rule::unique('arbitros')->ignore($this->route('arbitro'))
            ],
            'email' => [
                'bail',
                'required',
                'email:rfc,dns',
                Rule::unique('arbitros')->ignore($this->route('arbitro'))
            ],
        ];
    }
}
