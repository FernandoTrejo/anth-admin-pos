<?php

namespace App\Http\Controllers\API\movil;

use App\Http\Controllers\Controller;
use App\Models\VentaMovil;
use App\Models\VentaMovilProducto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\StatusVenta;

class ConsultarVentasMovilesController extends Controller
{
    public function Consultar($codigoSucursal)
    {
        try {
            $ventas = VentaMovil::where('status', StatusVenta::$abierta)->where('codigo_sucursal', $codigoSucursal)->get()->toArray();
            $newVentas = [];
            foreach($ventas as $venta){
                $venta['productos_orden'] = VentaMovilProducto::where('codigo_orden', $venta['codigo'])->get()->toArray();
                $newVentas[] = $venta;
            }
            $response = new APIResponse(200, true, '', [
                'ventas' => $newVentas
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
