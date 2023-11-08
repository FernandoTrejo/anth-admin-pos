<?php

namespace App\Http\Controllers\API\Usuarios\POS;

use App\Http\Controllers\Controller;
use App\Models\UsuarioPOS;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ActivarUsuarioPOSController extends Controller
{
    public function Activar(Request $request){
        try {
            $userID = $request->input('user_id');

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

            $user->status = 'activo';
            $user->save();

            $response =  new APIResponse(
                200,
                true,
                "Usuarios Activo",
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
