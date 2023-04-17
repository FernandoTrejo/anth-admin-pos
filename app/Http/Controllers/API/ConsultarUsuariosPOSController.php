<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UsuarioPOS;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarUsuariosPOSController extends Controller
{
    public function Consultar(){
        try {
            $usuarios = UsuarioPOS::get()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Usuarios POS",
                [
                    'usuarios' => $usuarios
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
