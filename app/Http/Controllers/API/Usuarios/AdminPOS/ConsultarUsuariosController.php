<?php

namespace App\Http\Controllers\API\Usuarios\AdminPOS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarUsuariosController extends Controller
{
    public function Consultar(){
        try {
            
            $users = User::with('roles')->get()->toArray();

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
