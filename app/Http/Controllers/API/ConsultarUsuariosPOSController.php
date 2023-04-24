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
            $usuariosConPermisos = [];
            $usuarios = UsuarioPOS::with('roles')->get();
            foreach($usuarios as $usuario){
                $permisosGlobal = [];
                foreach($usuario->roles as $rol){
                    $permisos = $rol->permissions()->get()->toArray();
                    $permisosGlobal = array_merge($permisosGlobal, $permisos);
                }
                $usuarioArr = $usuario->toArray();
                $usuarioArr['permisos'] = $permisosGlobal;
                $usuariosConPermisos[] = $usuarioArr;
            }

            $response =  new APIResponse(
                200,
                true,
                "Usuarios POS",
                [
                    'usuarios' => $usuariosConPermisos
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
