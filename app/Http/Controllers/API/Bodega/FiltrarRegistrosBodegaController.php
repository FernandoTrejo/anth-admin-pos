<?php

namespace App\Http\Controllers\API\Bodega;

use App\Http\Controllers\Controller;
use App\Models\BodegaProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class FiltrarRegistrosBodegaController extends Controller
{
    public function ConsultarPorCodigoSucursal(Request $request){
        try {
            $datos = $request->all();
            $clave_sucursal = $datos['codigo_sucursal'];
            $skip = $datos['skip'];
            $take = $datos['take'];

            $ultimoProducto = BodegaProducto::where('clave_sucursal', $clave_sucursal)->latest('id')->first();
            if(!$ultimoProducto){
                $response = new APIResponse(200, true, 'Info Bodega', [
                    'productos' => [],
                ]);
                return response()->json($response->toArray());
            }

            $cuenta = BodegaProducto::where('fecha', $ultimoProducto->fecha)->where('clave_sucursal', $clave_sucursal)->count();
            $ultimos = BodegaProducto::where('fecha', $ultimoProducto->fecha)->where('clave_sucursal', $clave_sucursal)->skip($skip)->take($take)->get();
            $productos = array_map(function($item){
                $prod = Producto::where('codigo', $item['codigo_producto'])->first();
                $item['info_producto'] = ($prod) ? $prod->toArray() : [];
                return $item;
            },  $ultimos->toArray());
     
            $response = new APIResponse(200, true, 'Info Bodega', [
                'productos' => $productos,
                'total' => $cuenta
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
