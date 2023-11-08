<?php

namespace App\Http\Controllers\API\Usuarios\POS;

use App\Http\Controllers\Controller;
use App\Models\RolUsuarioPOS;
use App\Models\UsuarioPOS;
use App\Models\UsuarioPosRolAsignado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;
use Illuminate\Support\Str;

class AgregarNuevoUsuarioPOSController extends Controller
{
    public function Agregar(Request $request)
    {
        try {
            $rolID = $request->input('rol_id');
            $usuario = trim($request->input('usuario'));
            $clave = trim($request->input('clave'));
            $nombre_empleado = trim($request->input('nombre_empleado'));
            $url_imagen = 'https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png';
            $status = 'activo';

            // 'tipo_empleado'
            $rol = RolUsuarioPOS::find($rolID);
            if (!$rol) {
                $response =  new APIResponse(
                    404,
                    false,
                    "Error, el rol especificado no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            $user = UsuarioPOS::where('usuario', $usuario)->first();
            if ($user) {
                $response =  new APIResponse(
                    404,
                    false,
                    "Error, el usuario ya existe",
                    []
                );
                return response()->json($response->toArray());
            }

            DB::transaction(function () use ($usuario, $clave, $nombre_empleado, $rol, $url_imagen, $status, $rolID) {
                $registro = UsuarioPOS::create([
                    'codigo' => Str::uuid(),
                    'usuario' => $usuario,
                    'clave' => $clave,
                    'nombre_empleado' => $nombre_empleado,
                    'tipo_empleado' => $rol->titulo,
                    'url_imagen' => $url_imagen,
                    'status' => $status
                ]);

                UsuarioPosRolAsignado::create([
                    'rol_id' => $rolID,
                    'usuario_pos_id' => $registro->id
                ]);
               
            });

            $response =  new APIResponse(
                200,
                true,
                "Usuario guardado con exito",
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
