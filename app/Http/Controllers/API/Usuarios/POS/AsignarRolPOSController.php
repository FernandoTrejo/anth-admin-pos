<?php

namespace App\Http\Controllers\API\Usuarios\POS;

use App\Http\Controllers\Controller;
use App\Models\RolUsuarioPOS;
use App\Models\UsuarioPOS;
use App\Models\UsuarioPosRolAsignado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class AsignarRolPOSController extends Controller
{
    public function Asignar(Request $request)
    {
        try {
            $rolID = $request->input('rol_id');
            $userID = $request->input('user_id');

            $rol = RolUsuarioPOS::find($rolID);
            $user = UsuarioPOS::find($userID);

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
                $registro = UsuarioPosRolAsignado::create([
                    'rol_id' => $rol->id,
                    'usuario_pos_id' => $user->id
                ]);

                $user->tipo_empleado = $rol->titulo;
                $user->save();
            });
            

            // if (!$registro) {
            //     $response =  new APIResponse(
            //         404,
            //         false,
            //         "Error, la informacion no se pudo guardar",
            //         []
            //     );
            //     return response()->json($response->toArray());
            // }

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
