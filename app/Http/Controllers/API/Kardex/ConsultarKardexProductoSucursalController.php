<?php

namespace App\Http\Controllers\API\Kardex;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class ConsultarKardexProductoSucursalController extends Controller
{
    public function Consultar($codigoProducto, $claveSucursal, $masRecientes){
        try {
            $kardex = DB::select("CALL x_SeleccionarKardexPorProductoYSucursal(?,?, ?)", [$codigoProducto, $claveSucursal, $masRecientes]);
            $response = new APIResponse(200, true, 'OK', [
                'total' => count($kardex),
                'kardex' => $kardex
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
