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
            $esSucursalOrigen = $datos['es_sucursal_origen'];

            $cambios = $this->DatosSegunAccion($datos, $estado);
            // $observacionesEnvio = isset($datos['observaciones_envio']) ? $datos['observaciones_envio'] : '';
            if($esSucursalOrigen === false){
                $observacionesRecepcion = isset($datos['observaciones_recepcion']) ? $datos['observaciones_recepcion'] : '';
                $cambios['observaciones_recepcion'] = $observacionesRecepcion;
            }
            // $cambios['observaciones_envio'] = $observacionesEnvio;
            
            Traslado::where('uuid', $datos['uuid'])->update($cambios);

            $response = new APIResponse(200, true, 'El estado ha sido modificado correctamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }

    private function DatosSegunAccion($datos, $estado)
    {
        if ($estado == $this->finalizado) {
            return [
                'status' => $estado,
                'fecha_recepcion_sucursal' => new DateTime(),
                'codigo_usuario_recibe' => $datos['codigo_usuario_recibe']
            ];
        }
        if ($estado == $this->cancelado) {
            return [
                'status' => $estado,
                'fecha_declinacion_sucursal' => new DateTime(),
                'codigo_usuario_rechaza' => $datos['codigo_usuario_rechaza']
            ];
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

    public function VerificarDisponibilidadTraslado($uuid, $accion)
    {
        $traslado = Traslado::where('uuid', $uuid)->first();
        if (!$traslado) {
            throw new Exception('El traslado no existe');
        }
        if ($accion == $this->cancelado) {
            if ($traslado->status === $this->cancelado || $traslado->status === $this->finalizado) {
                throw new Exception('El traslado ya no esta disponible');
            }
        }
        if ($accion == $this->finalizado) {
            if ($traslado->status === $this->cancelado || $traslado->status === $this->finalizado) {
                throw new Exception('El traslado ya no esta disponible');
            }
        }
    }
}
