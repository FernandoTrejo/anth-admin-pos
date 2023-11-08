<?php

namespace App\Http\Controllers\API\Usuarios\POS;

use App\Http\Controllers\Controller;
use App\Models\UsuarioPOS;
use Src\shared\APIResponse;

class ConsultarUsuariosPOSController extends Controller
{
    public function Consultar(){
        try {
            
            $users = UsuarioPOS::with('roles')->get()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Lista de Usuarios",
                [
                    'usuarios' => $users
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
