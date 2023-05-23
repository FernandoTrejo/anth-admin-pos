<?php

namespace App\Http\Controllers;

use App\Models\VentaMovil;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ActualizarEstadoVentaMovilController extends Controller
{
    public function CambiarEstado(Request $request){
        try {
            $datos = $request->all();

            VentaMovil::where('codigo', $datos['codigo'])->update(
                [
                    'status' => $datos['status']
                ]
            );

            $response = new APIResponse(200, true, 'El estado ha sido modificado correctamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
