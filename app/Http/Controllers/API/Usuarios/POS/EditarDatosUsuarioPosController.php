<?php

namespace App\Http\Controllers\API\Usuarios\POS;

use App\Http\Controllers\Controller;
use App\Models\UsuarioPOS;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class EditarDatosUsuarioPosController extends Controller
{
    public function Editar(Request $request){
        try {
            $userID = $request->input('id');
            $usuario = $request->input('usuario');
            $clave = $request->input('clave');
            $nombre_empleado = $request->input('nombre_empleado');
            $status = $request->input('status');

            $user = UsuarioPOS::find($userID);

            if (!$user) {
                $response =  new APIResponse(
                    404,
                    false,
                    "Error, el usuario especificado no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            $user->usuario = $usuario;
            $user->clave = $clave;
            $user->nombre_empleado = $nombre_empleado;
            $user->status = $status;
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
