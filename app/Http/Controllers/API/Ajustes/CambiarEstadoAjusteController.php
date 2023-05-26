<?php

namespace App\Http\Controllers\API\Ajustes;

use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use DateTime;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\StatusAjuste;
use Src\shared\StatusVenta;

class CambiarEstadoAjusteController extends Controller
{

    public function CambiarEstado(Request $request, $estado)
    {
        try {
            $request->validate([
                'id' => ['required']
            ]);
            $datos = $request->all();
            $user_code = auth('api')->user()->username;
            $datos['codigo_usuario'] = $user_code;

            $cambios = $this->DatosSegunAccion($datos, $estado);

            Ajuste::where('id', $datos['id'])->update($cambios);

            $response = new APIResponse(200, true, 'El estado ha sido modificado correctamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }

    private function DatosSegunAccion($datos, $estado)
    {
        if ($estado == StatusAjuste::$Authorized) {
            return [
                'status' => $estado,
                'fecha_autorizacion' => new DateTime(),
                'codigo_usuario_autoriza' => $datos['codigo_usuario']


            ];
        }
        if ($estado == StatusAjuste::$Denied) {
            return [
                'status' => $estado,
                'fecha_denegado' => new DateTime(),
                'codigo_usuario_rechaza' => $datos['codigo_usuario']
            ];
        }
        if ($estado == StatusAjuste::$Closed) {
            return [
                'status' => $estado
            ];
        }
    }

    public function Aceptar(Request $request)
    {
        return $this->CambiarEstado($request, StatusAjuste::$Authorized);
    }

    public function Rechazar(Request $request)
    {
        return $this->CambiarEstado($request, StatusAjuste::$Denied);
    }

    public function Cerrar(Request $request)
    {
        return $this->CambiarEstado($request, StatusAjuste::$Closed);
    }
}
