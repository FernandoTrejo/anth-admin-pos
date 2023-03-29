<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Src\shared\APIResponse;

class CambiarEstadoTrasladoController extends Controller
{
    private $inicial = 'inicial';
    private $finalizado = 'finalizado';
    private $cancelado = 'cancelado';

    public function CambiarEstado(Request $request, $estado){
        try {
            $datos = $request->validate([
                'uuid' => ['required']
            ]);
    
            Traslado::where('uuid', $datos['uuid'])->update([
                'status' => $estado
            ]);

            $response = new APIResponse(200, true, 'El estado ha sido modificado correctamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }

    public function Finalizar(Request $request){
        return $this->CambiarEstado($request, $this->finalizado);
    }

    public function Cancelar(Request $request){
        return $this->CambiarEstado($request, $this->cancelado);
    }
}
