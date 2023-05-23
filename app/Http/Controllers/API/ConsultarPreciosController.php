<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TipoPrecio;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarPreciosController extends Controller
{
    public function Consultar(){
        try {
            $precios = TipoPrecio::all()->toArray();
            $response =  new APIResponse(
                200,
                true,
                "Precios de productos",
                [
                    'precios' => $precios,
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
