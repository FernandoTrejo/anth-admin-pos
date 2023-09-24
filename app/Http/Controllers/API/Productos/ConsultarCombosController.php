<?php

namespace App\Http\Controllers\API\Productos;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarCombosController extends Controller
{
    public function Consultar($skip = 0, $take = 0)
    {
        try {
            $inventario = [];
            $count = Producto::where('contiene_productos', 'si')->count();
            if ($take > 0) {
                $inventario = Producto::where('contiene_productos', 'si')->skip($skip)->take($take)->get()->toArray();
            } else {
                $inventario = Producto::where('contiene_productos', 'si')->get()->toArray();
            }

            $response =  new APIResponse(
                200,
                true,
                "Listado de combos",
                [
                    'productos' => $inventario,
                    'total' => $count
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
