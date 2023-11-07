<?php

namespace App\Http\Controllers\API\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class VentasXHoraXSucursalController extends Controller
{
    public function Consultar(Request $request){
        try {
            $datos = $request->all();
            $fecha = $datos['date'];//YYYY-MM-DD
            $storeCode = $datos['store_code'];//YYYY-MM-DD
            $ventasHora = DB::select("CALL x_VentasPorHora(?,?)", [$storeCode, $fecha]);
            $response = new APIResponse(200, true, 'OK', [
                'ventas_hora' => $ventasHora
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
