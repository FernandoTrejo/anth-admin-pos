<?php

namespace App\Http\Controllers\API\Bodega;

use App\Http\Controllers\Controller;
use App\Models\BodegaProducto;
use Src\shared\APIResponse;

class ConsultarUltimosRegistrosBodegaController extends Controller
{
    public function ConsultarPorCodigoSucursal($clave_sucursal){
        try {
            $ultimoProducto = BodegaProducto::where('clave_sucursal', $clave_sucursal)->latest('id')->first();
            if(!$ultimoProducto){
                $response = new APIResponse(200, true, 'Info Bodega', [
                    'productos' => [],
                ]);
                return response()->json($response->toArray());
            }

            $ultimos = BodegaProducto::where('fecha', $ultimoProducto->fecha)->where('clave_sucursal', $clave_sucursal)->get();
     
            $response = new APIResponse(200, true, 'Info Bodega', [
                'productos' => $ultimos->toArray(),
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
