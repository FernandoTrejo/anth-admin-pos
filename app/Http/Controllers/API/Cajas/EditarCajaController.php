<?php

namespace App\Http\Controllers\API\Cajas;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class EditarCajaController extends Controller
{
    public function Editar(Request $request)
    {
        try {
            $request->validate([
                'codigo' => ['required']
            ]);

            $datos = $request->all();
            $codigo = $datos['titulo'];
            $caja = Caja::where('codigo', $codigo)->first();
            if(!$caja){
                $response = new APIResponse(404, false, 'El codigo de caja no existe', []);
                return response()->json($response->toArray());
            }

            $caja->titulo = $datos['titulo'];
            $caja->tipo = $datos['tipo'];
            $caja->save();

            $response = new APIResponse(200, true, 'Informacion modificada correctamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
