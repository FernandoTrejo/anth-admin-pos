<?php

namespace App\Http\Controllers\API\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class DetallePagosXSucursalController extends Controller
{
    public function Consultar(Request $request){
        try {
            $datos = $request->all();
            $fecha = $datos['date'];//YYYY-MM-DD
            $storeCode = $datos['store_code'];//YYYY-MM-DD
            $pagos = DB::select("CALL x_DetallePagosTicketsDiario(?,?)", [$storeCode, $fecha]);
            $response = new APIResponse(200, true, 'OK', [
                'detalle_pagos' => $pagos
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
