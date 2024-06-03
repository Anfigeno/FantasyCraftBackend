<?php

namespace App\Http\Controllers;

use App\Models\MensajeProgramado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MensajeProgramadoController extends Controller
{
    public function listar(): JsonResponse
    {
        $comandosPersonalizados = MensajeProgramado::all();

        return response()->json($comandosPersonalizados, 200);
    }

    public function obtener(string $id): JsonResponse
    {
        $comandoPersonalizado = MensajeProgramado::find($id);

        if (! $comandoPersonalizado) {
            return response()->json([
                'error' => "El comando $id no existe",
            ], 400);
        }

        return response()->json($comandoPersonalizado, 200);
    }

    public function actualizar(Request $request, string $id): JsonResponse|Response
    {
        $datos = $request->all();

        $validador = Validator::make($datos, [
            'titulo' => 'required|string|max:60',
            'descripcion' => 'required|string|max:400',
            'imagen' => 'string|max:300',
            'miniatura' => 'string|max:300',
            'tiempo' => 'required|string|max:5',
            'id_canal' => 'required|string|max:20',
            'activo' => 'boolean',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        try {
            $comandoPersonalizado = MensajeProgramado::find($id);
            $comandoPersonalizado->fill($datos);
            $comandoPersonalizado->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response(status: 200);
    }

    public function insertar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();

        foreach ($datos as $dato) {
            $validador = Validator::make($dato, [
                'titulo' => 'required|string|max:60',
                'descripcion' => 'required|string|max:400',
                'imagen' => 'string|max:300',
                'miniatura' => 'string|max:300',
                'tiempo' => 'required|string|max:5',
                'id_canal' => 'required|string|max:20',
                'activo' => 'required|boolean',
            ]);

            if ($validador->fails()) {
                return response()->json([
                    'error' => $validador->errors(),
                ], 400);
            }
        }

        MensajeProgramado::truncate();

        try {
            foreach ($datos as $dato) {
                $comandoPersonalizado = new MensajeProgramado();
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
