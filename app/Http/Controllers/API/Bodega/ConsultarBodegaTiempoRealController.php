<?php

namespace App\Http\Controllers\API\Bodega;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class ConsultarBodegaTiempoRealController extends Controller
{
    public function Consultar($claveSucursal){
        try {
            $bodega = DB::select("CALL GetRealTimeInventory(?)", [$claveSucursal]);
            $response = new APIResponse(200, true, 'OK', [
                'total' => count($bodega),
                'bodega' => $bodega
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
