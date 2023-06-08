<?php

namespace App\Http\Controllers\API\Anticipos;

use App\Http\Controllers\Controller;
use App\Models\Sucursal;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\TipoTransacciones;

class ConsultarAnticipoController extends Controller
{
    public function ConsultarPorNumeroTransaccion($numero, $skip, $take){
        try {
            $transacciones = Transaccion::where(['numero_transaccion' => $numero, 'tipo_transaccion' => TipoTransacciones::$AnticiposOrden])->skip($skip)->take($take)->get();
            $transaccionesInfo = $transacciones->toArray();

            $transaccionesInfo = array_map(function($t){
                $t['fecha_timestamp'] = strtotime($t['fecha']);
                return $t;
            }, $transaccionesInfo);

            $response = new APIResponse(200, true, 'Info Anticipo', [
                'anticipos' => $transaccionesInfo,
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
