<?php

namespace App\Http\Controllers;

use App\Models\ComandoPersonalizado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ComandoPersonalizadoController extends Controller
{
    public function listar(): JsonResponse
    {
        $comandosPersonalizados = ComandoPersonalizado::all();

        return response()->json($comandosPersonalizados, 200);
    }

    public function obtener(string $palabra_clave): JsonResponse
    {
        $comandoPersonalizado = ComandoPersonalizado::where('palabra_clave', $palabra_clave)->first();

        if (! $comandoPersonalizado) {
            return response()->json([
                'error' => "El comando $palabra_clave no existe",
            ], 400);
        }

        return response()->json($comandoPersonalizado, 200);
    }

    public function insertar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();

        foreach ($datos as $dato) {
            $validador = Validator::make($dato, [
                'palabra_clave' => 'string|max:50',
                'contenido' => 'string|max:200',
                'autor' => 'string|max:100',
            ]);

            if ($validador->fails()) {
                return response()->json([
                    'error' => $validador->errors(),
                ], 400);
            }
        }

        ComandoPersonalizado::truncate();

        try {
            foreach ($datos as $dato) {
                $comandoPersonalizado = new ComandoPersonalizado();
                $comandoPersonalizado->fill($dato);
                $comandoPersonalizado->save();
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response(status: 200);
    }
}
