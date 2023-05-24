<?php

namespace App\Http\Controllers\API\Ajustes;

use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use DateTime;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class GuardarAjusteController extends Controller
{
    public function Guardar(Request $request)
    {
        try {
            $user_id = auth('api')->user()->id;

            Ajuste::create([
                'fecha' => new DateTime(),
                'codigo_sucursal' => $request['codigo_sucursal'],
                'tipo' => $request['tipo'],
                'usuario_id' => $user_id,
            ]);

            $response =  new APIResponse(
                200,
                true,
                "Ajuste Solicitado con Exito",
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
