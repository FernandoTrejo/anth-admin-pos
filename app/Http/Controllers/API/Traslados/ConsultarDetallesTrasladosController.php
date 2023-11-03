<?php

namespace App\Http\Controllers\API\Traslados;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use App\Models\TrasladoProducto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarDetallesTrasladosController extends Controller
{
    public function Consultar($codigo)
    {
        try {
            $traslado = Traslado::where('uuid', $codigo)->first();
            if (!$traslado) {
                $response =  new APIResponse(
                    404,
                    false,
                    "EL traslado no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            $productos = TrasladoProducto::where('traslado_id', $traslado->id)->get();

            $response =  new APIResponse(
                200,
                true,
                "Detalles de transaccion",
                [
                    'traslado' => $traslado->toArray(),
                    'productos' => $productos->toArray()
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
