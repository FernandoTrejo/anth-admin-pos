<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\shared\APIResponse;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {

        try {
            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $user = User::where('username', $credentials['username'])->with('permissions')->first();
                
                $token = $user->createToken($user->name)->plainTextToken;
                $datosUser = $user->toArray();
                $datosUser['token'] = $token;
                $responseOK = new APIResponse(200, true, 'Credenciales correctas', [
                    'user' => $datosUser
                ]);
                return response()->json($responseOK->toArray());
            }

            $responseNotFound = new APIResponse(404, false, 'Credenciales incorrectas', []);
            return response()->json($responseNotFound->toArray());
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
