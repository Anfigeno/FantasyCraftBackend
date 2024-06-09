<?php

namespace App\Http\Controllers;

use App\Models\PalabrasProhibidas;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PalabrasProhibidasController extends Controller
{
    public function listar(): JsonResponse|Response
    {
        $palabras = PalabrasProhibidas::first();

        if (! $palabras) {
            $palabras = new PalabrasProhibidas();
            $palabras->save();
            $palabras->refresh();
        }

        return response()->json($palabras);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        $palabras = PalabrasProhibidas::first();

        if (! $palabras) {
            $palabras = new PalabrasProhibidas();
            $palabras->save();
            $palabras->refresh();
        }

        $datos = $request->all();

        $palabras->fill($datos);

        try {
            $palabras->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response(status: 200);
    }
}
