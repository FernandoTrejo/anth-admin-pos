<?php

namespace App\Http\Controllers\API\Solicitudes;

use App\Http\Controllers\Controller;
use App\Models\SolicitudOperacionTienda;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarInfoSolicitudController extends Controller
{
    public function Cerrar(Request $request)
    {
        try {
            $datos = $request->toArray();
            $id = $datos['id'];
            $itemBD = SolicitudOperacionTienda::find($id);
            if (!$itemBD) {
                $response = new APIResponse(
                    404,
                    false,
                    'No existe el item solicitado',
                    []
                );
                return response()->json($response->toArray());
            }

            $response =  new APIResponse(
                200,
                true,
                "Informacion Actualizada con Exito",
                [
                    'solicitud' => $itemBD->toArray()
                ]
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
