<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    public function listar(): JsonResponse
    {
        $tickets = Tickets::first();

        if (! $tickets) {
            $tickets = new Tickets();
            $tickets->save();
            $tickets->refresh();
        }

        return response()->json($tickets, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();
        $validador = Validator::make($datos, [
            'id_categoria' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $tickets = Tickets::first();
        if (! $tickets) {
            $tickets = new Tickets();
            $tickets->save();
            $tickets->refresh();
        }

        $tickets->fill($datos);

        try {
            $tickets->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response(status: 200);
    }
}
