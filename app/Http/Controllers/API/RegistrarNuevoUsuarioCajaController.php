<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Src\shared\APIResponse;

class RegistrarNuevoUsuarioCajaController extends Controller
{
    public function Registrar(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
                'username' => ['required'],
                'password' => ['required'],
                'codigo_caja' => ['required']
            ]);

            $datos = $request->all();

            $codigoCaja = $datos['codigo_caja'];

            $caja = Caja::where('codigo', $codigoCaja)->first();

            if (!$caja) {
                $responseNotFound = new APIResponse(404, false, 'No existe el codigo de caja', []);
                return response()->json($responseNotFound->toArray());
            }

            //verificar que no exista el usuario
            $usuarioBD = User::where('username', $datos['username'])->first();
            if (!$usuarioBD) {
                //registrar usuario
                if ($this->InsertarInfo($datos) === true) {
                    $cajaBD = Caja::where('codigo', $codigoCaja)->first();
                    $responseOK = new APIResponse(200, true, 'Token Generado con Exito', [
                        'caja' => $cajaBD->toArray()
                    ]);
                    return response()->json($responseOK->toArray());
                }
            }

            $responseOK = new APIResponse(200, true, 'Token ya ha sido generado', [
                'caja' => $caja->toArray()
            ]);
            return response()->json($responseOK->toArray());
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

    public function InsertarInfo($datos): bool
    {
        try {
            DB::transaction(function () use ($datos) {

                //registrar usuario
                $usuarioCaja = User::create([
                    'name' => $datos['name'],
                    'username' => $datos['username'],
                    'password' => Hash::make($datos['password']),
                ]);
                $usuarioCreado = User::where('username', $datos['username'])->first();
                $token = $usuarioCreado->createToken($usuarioCaja->name)->accessToken;

                $caja = Caja::where('codigo', $datos['username'])->first();
                $caja->token_api = $token;
                $caja->save();
            });
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
