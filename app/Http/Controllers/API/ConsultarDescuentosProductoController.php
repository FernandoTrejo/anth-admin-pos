<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarDescuentosProductoController extends Controller
{
    public function Consultar($codigo_producto){
        try {
            $producto = Producto::where('codigo', $codigo_producto)->first();

            if(!$producto){
                $response = new APIResponse(
                    404,
                    false,
                    'No existe ningun producto con el codigo solicitado',
                    []
                );
                return response()->json($response->toArray());
            }

            $descuentos = $producto->descuentos()->get()->toArray();
            $descuentos = array_map(function($descuento){
                $descuento['fecha_inicio_timestamp'] = strtotime($descuento['fecha_inicio']);
                $descuento['fecha_fin_timestamp'] = strtotime($descuento['fecha_fin']);
                return $descuento;
            }, $descuentos);

            $response =  new APIResponse(
                200,
                true,
                "Producto Descuentos",
                [
                    'descuentos' => $descuentos
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
