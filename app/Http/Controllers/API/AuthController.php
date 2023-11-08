<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
