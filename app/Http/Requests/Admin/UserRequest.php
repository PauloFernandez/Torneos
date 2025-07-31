<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file_uri' => [
                'bail', // 'bail' esta regla detiene la validacion de un campo si falla una regla anterior
                'nullable',
                File::image()->max(10 * 1024)->dimensions(Rule::dimensions()
                    ->maxWidth(650)->maxHeight(650)) // esta regla valida el formato de imagen y el tamaño máximo
            ],
            'documento' => [
                'bail',
                'required',
                'regex:/^[0-9\s]+$/', // 'regex' esta regla valida los caracteres permitidos en este caso acepta solo numeros
                'min:8',
                'max:8',
                Rule::unique('users')->ignore($this->route('usuario')) // Rule::unique valida que el campo sea unico, el 'ignore' sirve para cuando se esta editando
            ],
            'name' => [
                'bail',
                'required',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/' // 'regex' esta regla valida los caracteres permitidos en este caso no acepta numeros
            ],
            'apellido' => ['bail', 'required', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'fecha_nacimiento' => [
                'bail',
                'required',
                'date',
                'before:' . now()->subYears(12)->format('Y-m-d'), // 'before' valida que la fecha sea anterior a "xx" años desde hoy, con la instruccion now()->subYears() indicamos la cantidad de años
                'after:' . now()->subYears(85)->format('Y-m-d')
            ],
            'direccion' => ['bail', 'required'],
            'telefono' => [
                'bail',
                'required',
                'regex:/^[0-9\s]+$/',
                'min:8',
                'max:9',
                Rule::unique('users')->ignore($this->route('usuario'))
            ],
            'email' => [
                'bail',
                'required',
                'email:rfc,dns',
                Rule::unique('users')->ignore($this->route('usuario'))
            ],
            'estado' => ['bail', 'required'],
            'password' => ['bail', 'required', 'min:6'],
        ];
    }
}
