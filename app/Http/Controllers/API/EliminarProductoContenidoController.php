<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoContenido;
use Exception;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\SiNoStatus;

class EliminarProductoContenidoController extends Controller
{

    public function Eliminar(Request $request)
    {
        try {
            $datos = $request->all();
            $id = $datos['producto_contenido_id'];

            $itemEliminar = ProductoContenido::find($id);
            if (!$itemEliminar) {
                throw new Exception("No existe este id");
            }

            $producto_id = $itemEliminar->producto_id;

            $producto = Producto::find($producto_id);
            if (!$producto) {
                throw new Exception("No existe el producto");
            }

            ProductoContenido::destroy($id);

            $cantidad = $producto->ProductosContenidos()->count();
            if ($cantidad === 0) {
                $producto->contiene_productos = SiNoStatus::$No;
                $producto->save();
            }

            $response =  new APIResponse(
                200,
                true,
                "La informacion ha sido eliminada con exito",
                []
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
