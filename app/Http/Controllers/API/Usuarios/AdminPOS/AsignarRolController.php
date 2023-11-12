<?php

namespace App\Http\Controllers\API\Usuarios\AdminPOS;

use App\Http\Controllers\Controller;
use App\Models\RolUsuarioPOS;
use App\Models\User;
use App\Models\UsuarioRolAsignado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

            DB::transaction(function() use ($user, $rol){
                UsuarioRolAsignado::where('usuario_id', $user->id)->delete();
                $registro = UsuarioRolAsignado::create([
                    'rol_id' => $rol->id,
                    'usuario_id' => $user->id
                ]);

                $user->tipo_empleado = $rol->titulo;
                $user->save();
            });

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
