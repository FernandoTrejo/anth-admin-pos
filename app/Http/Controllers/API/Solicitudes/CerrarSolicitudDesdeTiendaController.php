<?php

namespace App\Http\Controllers\API\Solicitudes;

use App\Http\Controllers\Controller;
use App\Models\SolicitudOperacionTienda;
use DateTime;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class CerrarSolicitudDesdeTiendaController extends Controller
{

    private $limiteTiempoMinutos = 30;
    public function Cerrar(Request $request)
    {
        try {
            $datos = $request->toArray();
            $codigo = $datos['codigo_solicitud'];
            $itemBD = SolicitudOperacionTienda::where('codigo', $codigo)->first();
            if (!$itemBD) {
                $response = new APIResponse(
                    404,
                    false,
                    'No existe el item solicitado',
                    [
                        'error' => 'not-found'
                    ]
                );
                return response()->json($response->toArray());
            }


            /**VERIFICAR LIMITE DE TIEMPO */
            $start_datetime = new DateTime($itemBD->fecha_solicitud);
            $diff = $start_datetime->diff(new DateTime());

            $total_minutes = ($diff->days * 24 * 60);
            $total_minutes += ($diff->h * 60);
            $total_minutes += $diff->i;

            if($total_minutes > $this->limiteTiempoMinutos){
                $response = new APIResponse(
                    500,
                    false,
                    'Esta solicitud ha expirado. Solicite una nueva.',
                    [
                        'error' => 'time-limit'
                    ]
                );
                return response()->json($response->toArray());
            }

            /**VERIFICAR QUE HAYA SIDO ACEPTADA */

            if($itemBD->status == 'inicial'){
                $response = new APIResponse(
                    500,
                    false,
                    'Esta solicitud todavia no ha sido aceptada. Consulte con la persona designada.',
                    [
                        'error' => 'not-accepted-yet'
                    ]
                );
                return response()->json($response->toArray());
            }

            if($itemBD->status == 'rechazada'){
                $response = new APIResponse(
                    500,
                    false,
                    'Esta solicitud ha sido rechazada.',
                    [
                        'error' => 'denied'
                    ]
                );
                return response()->json($response->toArray());
            }

            if($itemBD->status == 'cerrada'){
                $response = new APIResponse(
                    500,
                    false,
                    'La solicitud ya no esta disponible.',
                    [
                        'error' => 'not-available'
                    ]
                );
                return response()->json($response->toArray());
            }

            $itemBD->status = 'cerrada';
            $itemBD->save();

            $response =  new APIResponse(
                200,
                true,
                "Informacion Actualizada con Exito",
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
