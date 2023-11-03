<?php

namespace App\Http\Controllers\API\Menu;

use App\Http\Controllers\Controller;
use App\Models\CategoriaContieneProducto;
use App\Models\CategoriaMenu;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class EliminarItemMenuController extends Controller
{
    public function Eliminar(Request $request)
    {
        try {
            $idProducto = $request->input('id_producto');
            $idCategoria = $request->input('id_categoria');


            $categoria = CategoriaMenu::find($idCategoria);
            $producto = Producto::find($idProducto);

            if(!$categoria){
                $response =  new APIResponse(
                    404,
                    false,
                    "La categoria no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            if(!$producto){
                $response =  new APIResponse(
                    404,
                    false,
                    "El producto no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            CategoriaContieneProducto::where(['categoria_id' => $idCategoria,'producto_id' => $idProducto])->delete();

            $response =  new APIResponse(
                200,
                true,
                "Menu borrado",
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
