<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarProductosContenidosController extends Controller
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

            $productosContenidos = $producto->ProductosContenidos()->get()->toArray();
            $productosContenidos = array_map(function($prod){
                $productoInve = Producto::where('codigo', $prod['codigo_producto_contenido'])->first();
                $descripcion = $productoInve ? $productoInve->nombre : "";
                $prod['descripcion'] = $descripcion;
                return $prod;
            }, $productosContenidos);

            $response =  new APIResponse(
                200,
                true,
                "Productos Contenidos",
                [
                    'productos_contenidos' => $productosContenidos
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
