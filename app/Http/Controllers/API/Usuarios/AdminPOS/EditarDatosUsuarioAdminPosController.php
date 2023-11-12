<?php

namespace App\Http\Controllers\API\Usuarios\AdminPOS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class EditarDatosUsuarioAdminPosController extends Controller
{
    public function Editar(Request $request){
        try {
            $userID = $request->input('id');
            $usuario = $request->input('username');
            $clave = $request->input('password');
            $nombre = $request->input('name');

            $user = User::find($userID);

            if (!$user) {
                $response =  new APIResponse(
                    404,
                    false,
                    "Error, el usuario especificado no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            $user->username = $usuario;
            $user->password = Hash::make($clave);
            $user->name = $nombre;
            $user->save();
            
            $response =  new APIResponse(
                200,
                true,
                "Usuario Modificado Exitosamente",
                []
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
