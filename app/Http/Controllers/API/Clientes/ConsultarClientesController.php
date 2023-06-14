<?php

namespace App\Http\Controllers\API\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarClientesController extends Controller
{
    public function Consultar()
    {
        try {
            $clientes = Cliente::all()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Clientes",
                [
                    'clientes' => $clientes,
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
