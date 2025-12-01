<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;

class JugadorImport implements ToCollection, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Crear el usuario
            $user = User::create([
                'documento' => $row['documento'],
                'name' => $row['name'],
                'apellido' => $row['apellido'],
                'fecha_nacimiento' => $row['fecha_nacimiento'],
                'direccion' => $row['direccion'],
                'telefono' => $row['telefono'],
                'email' => $row['email'],
                'password' => $row['password'],
            ]);

            // Asignar rol de jugador
            $user->assignRole('jugador');
        }
    }

        public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    //Reglas de validacion 
    public function rules(): array
    {
        return [
            'documento' => [
                'bail',
                'required',
                'regex:/^[0-9\s]+$/', // 'regex' esta regla valida los caracteres permitidos en este caso acepta solo numeros
                'min:8',
                'max:8',
                Rule::unique('users') // Rule::unique valida que el campo sea unico, el 'ignore' sirve para cuando se esta editando
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
                Rule::unique('users')
            ],
            'email' => [
                'bail',
                'required',
                'email:rfc,dns',
                Rule::unique('users')
            ],
            'password' => [
                'bail',
                'required',
                ]
        ];
    }
}
