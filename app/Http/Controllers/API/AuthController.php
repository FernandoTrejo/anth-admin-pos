<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
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

        if(!$usuario){
            return response()->json([
                'status' => 'User not created'
            ]);
        }

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
