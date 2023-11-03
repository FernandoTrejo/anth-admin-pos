<?php

namespace App\Http\Controllers\API\Transacciones;

use App\Http\Controllers\Controller;
use App\Models\Transaccion;
use App\Models\TransaccionPago;
use App\Models\TransaccionProducto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarDetallesTransaccionController extends Controller
{
    public function Consultar($codigo)
    {
        try {
            $transaccion = Transaccion::where('codigo', $codigo)->first();
            if(!$transaccion){
                $response =  new APIResponse(
                    404,
                    false,
                    "La transaccion no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            $productos = TransaccionProducto::where('codigo_orden', $codigo)->get();
            $pagos = TransaccionPago::where('codigo_orden', $codigo)->get();
            $response =  new APIResponse(
                200,
                true,
                "Detalles de transaccion",
                [
                    'transaccion' => $transaccion->toArray(),
                    'productos' => $productos->toArray(),
                    'pagos' => $pagos->toArray()
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
