<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class GestionImagService
{
    protected string $defaultPath = 'img';
    protected string $defaultField = 'file_uri';

    public function storage(Request $request, Model $model, ?string $field = null, ?string $path = null): void
    {
        $field = $field ?? $this->defaultField;
        $path = $path ?? $this->defaultPath;

// Debugging: ver qué datos llegan IMPORTANTE 
/*
        dd([
            'field' => $field,
            'path' => $path,
            'model_id' => $model->id,
            'has_file' => $request->hasFile($field),
            'all_files' => $request->files->all()
        ]);
*/

        if ($request->hasFile($field)) {
            $file = $request->file($field);
// Debugging: ver qué datos espesificos de la imagen
/*
        dd([
            'original_name' => $file->getClientOriginalName(),
            'extension' => $file->extension(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType()
        ]);
*/

            $fileName = $model->id . '-' . time() . '.' . $file->extension();
// Debugging: ver qué datos de la direccion en dond guardara la imagen, nombre y extencion de la imagen.
/*
        dd([
            'generated_filename' => $fileName,
            'destination_path' => public_path($path)
        ]);
*/
            $file->move(public_path($path), $fileName);
            $model->{$field} = $fileName;
            $model->save();
        }
        
    }

    public function update(Request $request, Model $model, ?string $field = null, ?string $path = null): void
    {
        $field = $field ?? $this->defaultField;
        $path = $path ?? $this->defaultPath;

        if ($request->hasFile($field)) {
            if ($model->{$field} && !empty($model->{$field})) {
                $oldImagePath = public_path($path . '/' . $model->{$field});
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $this->storage($request, $model, $field, $path);
        }
    }

    public function delete(Model $model, ?string $field = null, ?string $path = null): void
    {
        $field = $field ?? $this->defaultField;
        $path = $path ?? $this->defaultPath;

        if ($model->{$field}) {
            $filePath = public_path($path . '/' . $model->{$field});
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}