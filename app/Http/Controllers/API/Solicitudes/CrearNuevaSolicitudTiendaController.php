<?php

namespace App\Http\Controllers\API\Solicitudes;

use App\Http\Controllers\Controller;
use App\Models\SolicitudOperacionTienda;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Src\shared\APIResponse;

class CrearNuevaSolicitudTiendaController extends Controller
{
    /*
    0->prueba cc
    1->autoconsumo
    2->destruccion cakes
    */
    public function Crear(Request $request)
    {
        try {
            $solicitud = SolicitudOperacionTienda::create([
                'codigo' => Str::uuid(),
                'fecha_solicitud' => new DateTime(),
                'codigo_usuario_solicitante' => $request['codigo_usuario_solicitante'],
                'status' => 'inicial',
                'tipo_solicitud' => $request['tipo_solicitud'],
                'codigo_sucursal' => $request['codigo_sucursal'],
                'codigo_caja' => $request['codigo_caja']
            ]);

            $response =  new APIResponse(
                200,
                true,
                "La solicitud ha sido enviada",
                [
                    'codigo_solicitud' => $solicitud->codigo
                ]
            );

            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse(
                $th->getCode(),
                false,
                $th->getMessage(),
                []
            );
            return response()->json($response->toArray());
        }
    }
}
