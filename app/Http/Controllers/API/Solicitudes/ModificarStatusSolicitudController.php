<?php

namespace App\Http\Controllers\API\Solicitudes;

use App\Http\Controllers\Controller;
use App\Models\SolicitudOperacionTienda;
use DateTime;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ModificarStatusSolicitudController extends Controller
{
    public function Editar(Request $request)
    {
        try {
            $user_id = auth('api')->user()->id;
            $datos = $request->toArray();
            $id = $datos['id'];
            $status = $datos['status'];
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
            $itemBD->id_usuario_gestion = $user_id;
            $itemBD->fecha_resolucion = new DateTime();
            $itemBD->status = $status;
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
