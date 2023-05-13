<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarInfoEmpresaController extends Controller
{
    public function Consultar()
    {
        try {
            $empresa = Empresa::first()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Empresa Info",
                [
                    'empresa' => $empresa
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
