<?php

namespace App\Http\Controllers\API\Cajas;

use App\Http\Controllers\Controller;
use App\Models\InfoEmisionTicket;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class EditarInfoTicketController extends Controller
{
    public function Editar(Request $request)
    {
        try {
            $request->validate([
                'id' => ['required']
            ]);

            $datos = $request->all();
            $id = $datos['id'];
            $info = InfoEmisionTicket::find($id);
            if (!$info) {
                InfoEmisionTicket::create([
                    'autorizacion_caja' => $datos['autorizacion_caja'],
                    'numero_serie' => $datos['numero_serie'],
                    'rango_documentos' => $datos['rango_documentos'],
                    'numero_resolucion' => $datos['numero_resolucion'],
                    'fecha_resolucion' => $datos['fecha_resolucion'],
                    'nombre_empresa' => $datos['nombre_empresa'],
                    'nit_empresa' => $datos['nit_empresa'],
                    'lugar_emision' => $datos['lugar_emision'],
                    'caja_id' => $datos['caja_id'],
                ]);
            } else {

                $info->autorizacion_caja = $datos['autorizacion_caja'];
                $info->numero_serie = $datos['numero_serie'];
                $info->rango_documentos = $datos['rango_documentos'];
                $info->numero_resolucion = $datos['numero_resolucion'];
                $info->fecha_resolucion = $datos['fecha_resolucion'];
                $info->nombre_empresa = $datos['nombre_empresa'];
                $info->nit_empresa = $datos['nit_empresa'];
                $info->lugar_emision = $datos['lugar_emision'];
                $info->save();
            }


            $response = new APIResponse(200, true, 'Informacion modificada correctamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
