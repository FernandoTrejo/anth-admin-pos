<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarProductosController extends Controller
{
    public function Consultar()
    {
        try {
            $productos = Producto::with([
                'ProductosContenidos',
                'precios',
                'descuentos',
                'derivados'
            ])->get()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Productos",
                [
                    'productos' => $productos,
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
