<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarVendedoresController extends Controller
{
    public function ConsultarTodos(){
        try {
            $vendedores = Vendedor::all()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Vendedores",
                [
                    'vendedores' => $vendedores
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
