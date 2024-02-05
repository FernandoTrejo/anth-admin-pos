<?php

namespace App\Http\Controllers\Temporal;

use App\Http\Controllers\Controller;
use App\Models\ClientesFE;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ActualizarDatosFacturaElectronica extends Controller
{
    public function Actualizar(Request $request){
        try {
            $datos = $request->all();

            ClientesFE::create($datos);

            $response = new APIResponse(200, true, 'Los datos han sido guardados exitosamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
