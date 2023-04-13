<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CategoriaMenu;
use App\Models\ProductoMenu;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarMenuProductosController extends Controller
{
    public function Consultar(){
        try {
            $categorias = CategoriaMenu::with('productos')->get()->toArray();
            // $categorias = CategoriaMenu::get()->toArray();
            // $productos = ProductoMenu::where('status', 'activo')->get()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Categorias y productos del menu",
                [
                    'categorias' => $categorias
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
