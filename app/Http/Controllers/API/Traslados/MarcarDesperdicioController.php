<?php

namespace App\Http\Controllers\API\Traslados;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\StatusTraslados;

class MarcarDesperdicioController extends Controller
{
    public function Marcar(Request $request)
    {
        try {
            
            $id = $request->input('traslado_id');
            $esDesperdicio = $request->input('es_desperdicio');
            
            $traslado = Traslado::find($id);
            if(!$traslado){
                $response =  new APIResponse(
                    404,
                    false,
                    "El traslado solicitado no existe",
                    []
                );
    
                return response()->json($response->toArray());
            }

            if($traslado->status == StatusTraslados::$Inicial){
                $response =  new APIResponse(
                    404,
                    false,
                    "El status del traslado es incorrecto",
                    []
                );
    
                return response()->json($response->toArray());
            }
            
            $traslado->es_desperdicio = ($esDesperdicio == true) ? 'si' : 'no';

            $traslado->save();
            $response =  new APIResponse(
                200,
                true,
                "Esta transaccion ha sido marcada como desperdicio",
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
