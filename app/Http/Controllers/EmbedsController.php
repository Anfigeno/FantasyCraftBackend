<?php

namespace App\Http\Controllers;

use App\Models\Embeds;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EmbedsController extends Controller
{
    public function listar(): JsonResponse
    {
        $embeds = Embeds::first();

        if (! $embeds) {
            $embeds = new Embeds();
            $embeds->save();
            $embeds->refresh();
        }

        return response()->json($embeds, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();

        $validador = Validator::make($datos, [
            'color' => 'string|max:7',
            'url_imagen_limitadora' => 'string|max:500',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $embeds = Embeds::first();

        if (! $embeds) {
            $embeds = new Embeds();
            $embeds->save();
            $embeds->refresh();
        }

        $embeds->fill($datos);

        try {
            $embeds->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response(status: 200);
    }
}
