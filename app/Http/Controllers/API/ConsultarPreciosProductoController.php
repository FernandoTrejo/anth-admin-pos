<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PrecioProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarPreciosProductoController extends Controller
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

            $precios = $producto->precios()->get();

            $response =  new APIResponse(
                200,
                true,
                "Precios Producto",
                [
                    'precios' => $precios->toArray()
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
