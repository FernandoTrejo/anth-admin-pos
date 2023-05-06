<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Src\shared\APIResponse;

class CambiarEstadoTrasladoController extends Controller
{
    private $inicial = 'inicial';
    private $finalizado = 'finalizado';
    private $cancelado = 'cancelado';

    public function CambiarEstado(Request $request, $estado)
    {
        try {
            $request->validate([
                'uuid' => ['required']
            ]);
            $datos = $request->all();

            $this->VerificarDisponibilidadTraslado($datos['uuid'], $estado);

            $observacionesEnvio = $datos['observaciones_envio'] ? $datos['observaciones_envio'] : '';
            $observacionesRecepcion = $datos['observaciones_recepcion'] ? $datos['observaciones_recepcion'] : '';

            $cambios = [
                'status' => $estado,
                'observaciones_envio' => $observacionesEnvio,
                'observaciones_recepcion' => $observacionesRecepcion
            ];
            switch ($estado) {
                case $this->cancelado:
                    $cambios['fecha_declinacion_sucursal'] = new DateTime();
                    break;
                case $this->finalizado:
                    $cambios['fecha_recepcion_sucursal'] = new DateTime();
                    break;
            }
            Traslado::where('uuid', $datos['uuid'])->update($cambios);

            $response = new APIResponse(200, true, 'El estado ha sido modificado correctamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }

    public function Finalizar(Request $request)
    {
        return $this->CambiarEstado($request, $this->finalizado);
    }

    public function Cancelar(Request $request)
    {
        return $this->CambiarEstado($request, $this->cancelado);
    }

    public function VerificarDisponibilidadTraslado($uuid, $accion){
        $traslado = Traslado::where('uuid', $uuid)->first();
        if(!$traslado){
            throw new Exception('El traslado no existe');
        }
        if($accion == $this->cancelado){
            if($traslado->status === $this->cancelado || $traslado->status === $this->finalizado){
                throw new Exception('El traslado ya no esta disponible');
            }
        }
        if($accion == $this->finalizado){
            if($traslado->status === $this->cancelado){
                throw new Exception('El traslado ya no esta disponible');
            }
        }
    }
}
