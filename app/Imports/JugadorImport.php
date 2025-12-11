<?php

namespace App\Imports;

use App\Events\WelcomeEmailEvent;
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

            //event(new WelcomeEmailEvent($user));
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
                'regex:/^[0-9\s]+$/',
                'min:8',
                'max:8',
                Rule::unique('users')
            ],
            'name' => [
                'bail',
                'required',
                'max:50',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'apellido' => ['bail', 'required', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'fecha_nacimiento' => [
                'bail',
                'required',
                'date',
                'before:' . now()->subYears(12)->format('Y-m-d'),
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
