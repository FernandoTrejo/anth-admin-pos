<?php

namespace App\Http\Controllers\API\Cajas;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarCajaController extends Controller
{
    public function ConsultarCodigo($codigoCaja)
    {
        try {
            $caja = Caja::where('codigo', $codigoCaja)->with('infoticket')->with('infofactura')->with('infocredito')->first();
            if(!$caja){
                $response = new APIResponse(404, false, 'El codigo de caja no existe', []);
                return response()->json($response->toArray());
            }

            $response = new APIResponse(200, true, 'Info Caja', [
                'caja' => $caja->toArray()
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
