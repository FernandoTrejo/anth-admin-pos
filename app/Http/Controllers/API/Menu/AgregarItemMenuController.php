<?php

namespace App\Http\Controllers\API\Menu;

use App\Http\Controllers\Controller;
use App\Models\CategoriaContieneProducto;
use App\Models\CategoriaMenu;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class AgregarItemMenuController extends Controller
{
    public function Agregar(Request $request)
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

            CategoriaContieneProducto::create([
                'categoria_id' => $idCategoria,
                'producto_id' => $idProducto
            ]);

            $response =  new APIResponse(
                200,
                true,
                "Menu agregado",
                [
                    'producto' => $producto->toArray(),
                    'categoria' => $categoria->toArray()
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
