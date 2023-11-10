<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Carbon\Carbon;
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

    public function ConsultarTodos()
    {
        try {
            $productos = Producto::all()->toArray();

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

    public function UltimosModificados()
    {
        try {
            $yesterday = Carbon::yesterday();
            $tomorrow = Carbon::tomorrow();

            $productos = Producto::whereBetween('updated_at', [$yesterday, $tomorrow])->with([
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
