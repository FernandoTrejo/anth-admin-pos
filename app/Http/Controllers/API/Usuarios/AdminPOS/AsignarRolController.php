<?php

namespace App\Http\Controllers\API\Usuarios\AdminPOS;

use App\Http\Controllers\Controller;
use App\Models\RolUsuarioPOS;
use App\Models\User;
use App\Models\UsuarioRolAsignado;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class AsignarRolController extends Controller
{
    public function Asignar(Request $request)
    {
        try {
            $rolID = $request->input('rol_id');
            $userID = $request->input('user_id');

            $rol = RolUsuarioPOS::find($rolID);
            $user = User::find($userID);


            if (!$rol) {
                $response =  new APIResponse(
                    404,
                    false,
                    "Error, el rol especificado no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            if (!$user) {
                $response =  new APIResponse(
                    404,
                    false,
                    "Error, el usuario especificado no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            $registro = UsuarioRolAsignado::create([
                'rol_id' => $rolID,
                'usuario_id' => $userID
            ]);

            if (!$registro) {
                $response =  new APIResponse(
                    404,
                    false,
                    "Error, la informacion no se pudo guardar",
                    []
                );
                return response()->json($response->toArray());
            }

            $response =  new APIResponse(
                200,
                true,
                "Rol asignado con exito",
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
