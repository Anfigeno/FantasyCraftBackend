<?php

namespace App\Http\Controllers;

use App\Models\RolesDeAdministracion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RolesDeAdministracionController extends Controller
{
    public function listar(): JsonResponse
    {
        $rolesDeAdministracion = RolesDeAdministracion::first();

        if (! $rolesDeAdministracion) {
            $rolesDeAdministracion = new RolesDeAdministracion();
            $rolesDeAdministracion->save();
            $rolesDeAdministracion->refresh();
        }

        return response()->json($rolesDeAdministracion, 200);
    }

    public function actualizar(Request $request): JsonResponse|Response
    {
        $datos = $request->all();

        $validador = Validator::make($datos, [
            'id_administrador' => 'string|max:20',
            'id_staff' => 'string|max:20',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'error' => $validador->errors(),
            ], 400);
        }

        $rolesDeAdministracion = RolesDeAdministracion::first();

        if (! $rolesDeAdministracion) {
            $rolesDeAdministracion = new RolesDeAdministracion();
            $rolesDeAdministracion->save();
            $rolesDeAdministracion->refresh();
        }

        $rolesDeAdministracion->fill($datos);

        try {
            $rolesDeAdministracion->save();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response(status: 200);
    }
}
