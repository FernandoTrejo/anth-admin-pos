<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

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
    
            $traslado = Traslado::where('uuid', $datos['uuid'])->update([
                'status' => $estado
            ]);
            // $traslado->status = $estado;
            // $traslado->save();
            return response()->json(
                [
                    'codigo' => 200,
                    'msg' => 'El estado ha sido modificado correctamente'
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'codigo' => $th->getCode(),
                    'msg' => $th->getMessage()
                ]
            );
        }
    }

    public function Finalizar(Request $request){
        return $this->CambiarEstado($request, $this->finalizado);
    }

    public function Cancelar(Request $request){
        return $this->CambiarEstado($request, $this->cancelado);
    }
}
