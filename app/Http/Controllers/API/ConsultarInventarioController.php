<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarInventarioController extends Controller
{
    public function ConsultarInventarioActivo($skip = 0, $take = 0)
    {
        try {
            $inventario = [];

            if ($take > 0) {
                $inventario = Producto::skip($skip)->take($take)->get()->toArray();
            } else {
                $inventario = Producto::get()->toArray();
            }

            $response =  new APIResponse(
                200,
                true,
                "Inventario de productos activos",
                $inventario
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



    public function CantidadInventarioActivo()
    {
        try {
            $count = Producto::count();
            $response =  new APIResponse(
                200,
                true,
                "Inventario de productos activos",
                $count
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
