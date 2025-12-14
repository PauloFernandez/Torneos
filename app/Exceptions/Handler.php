<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [];

    protected $dontReport = [];
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        
        if ($exception instanceof QueryException) {
            if (isset($exception->errorInfo[0]) && $exception->errorInfo[0] === '23000') {
                $mysqlErrorCode = $exception->errorInfo[1] ?? null;
                
                // 1451: Cannot delete or update a parent row (FOREIGN KEY RESTRICT/NO ACTION)
                if ($mysqlErrorCode == 1451) {
                    return $this->handleForeignKeyRestrict($request);
                }
                
                // 1452: Cannot add or update a child row (referencia inexistente)
                if ($mysqlErrorCode == 1452) {
                    return $this->handleForeignKeyInsert($request);
                }
                
                // 1062: Duplicate entry (UNIQUE constraint)
                if ($mysqlErrorCode == 1062) {
                    return $this->handleDuplicateEntry($request);
                }
            }
        }
        return parent::render($request, $exception);
    }

    /**
     * Manejar error al intentar eliminar registro con relaciones (RESTRICT)
     */
    protected function handleForeignKeyRestrict($request)
    {
        $mensaje = 'No se puede eliminar este registro porque está siendo utilizado por otros datos del sistema. '
                 . 'Primero debes eliminar o modificar los registros relacionados.';
        
        // Si es petición AJAX/API
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'error' => $mensaje,
                'type' => 'foreign_key_restrict'
            ], 409);
        }
        
        // Si es petición web normal
        return redirect()->back()
            ->withInput()
            ->with('error', $mensaje);
    }

    /**
     * Manejar error al intentar crear/actualizar con referencia inexistente
     */
    protected function handleForeignKeyInsert($request)
    {
        $mensaje = 'El registro que intentas guardar hace referencia a datos que no existen en el sistema.';
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'error' => $mensaje,
                'type' => 'foreign_key_invalid'
            ], 422);
        }
        
        return redirect()->back()
            ->withInput()
            ->with('error', $mensaje);
    }

    /**
     * Manejar error de duplicado (UNIQUE constraint)
     */
    protected function handleDuplicateEntry($request)
    {
        $mensaje = 'Ya existe un registro con estos datos. Por favor verifica la información e intenta nuevamente.';
        
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'error' => $mensaje,
                'type' => 'duplicate_entry'
            ], 422);
        }
        
        return redirect()->back()
            ->withInput()
            ->with('error', $mensaje);
    }
}
