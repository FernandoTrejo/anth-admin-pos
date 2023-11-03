<?php

namespace App\Http\Controllers\API\Menu;

use App\Http\Controllers\Controller;
use App\Models\CategoriaMenu;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarMenuActivoController extends Controller
{
    public function Consultar()
    {
        try {
            
            $categorias = CategoriaMenu::with('productos')->where('status', 'activo')->get();
            $response =  new APIResponse(
                200,
                true,
                "Listado de categorias",
                [
                    'categorias' => $categorias->toArray()
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
