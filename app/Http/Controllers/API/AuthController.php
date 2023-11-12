<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RolUsuarioPOS;
use App\Models\User;
use App\Models\UsuarioRolAsignado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Src\shared\APIResponse;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = $request->all();
            $name = $data['name'];
            $username = $data['username'];
            $password = $data['password'];
            $rolID = $request->input('rol_id');
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

            $user = User::where('username', $username)->first();
            if ($user) {
                $response =  new APIResponse(
                    404,
                    false,
                    "Error, el usuario ya existe",
                    []
                );
                return response()->json($response->toArray());
            }

            $usuario = User::create(
                [
                    'name' => $name,
                    'username' => $username,
                    'password' => Hash::make($password)
                ]

            );

            if (!$usuario) {
                $response =  new APIResponse(
                    500,
                    false,
                    "El usuario no ha sido registrado",
                    []
                );
    
                return response()->json($response->toArray());
            }

            DB::transaction(function() use ($usuario, $rol){
                UsuarioRolAsignado::where('usuario_id', $usuario->id)->delete();
                $registro = UsuarioRolAsignado::create([
                    'rol_id' => $rol->id,
                    'usuario_id' => $usuario->id
                ]);
            });

            $response =  new APIResponse(
                200,
                true,
                "El usuario ha sido registrado",
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

    public function changePassword(Request $request)
    {
        try {
            $data = $request->all();
            $username = $data['username'];
            $password = $data['password'];

            $usuario = User::where('username', $username)->first();

            if (!$usuario) {
                $response =  new APIResponse(
                    404,
                    false,
                    "El usuario no existe",
                    []
                );
    
                return response()->json($response->toArray());
            }

            $usuario->password = Hash::make($password);
            $usuario->save();
            
            $response =  new APIResponse(
                200,
                true,
                "La clave ha sido modificada exitosamente",
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
