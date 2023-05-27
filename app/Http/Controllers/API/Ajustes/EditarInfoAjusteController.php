<?php

namespace App\Http\Controllers\API\Ajustes;

use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class EditarInfoAjusteController extends Controller
{
    public function Editar(Request $request)
    {
        try {
            $datos = $request->toArray();
            $id = $datos['id'];
            $ajusteBD = Ajuste::where('id', $id)->first();
            if (!$ajusteBD) {
                $response = new APIResponse(
                    404,
                    false,
                    'No existe el ajuste solicitado',
                    []
                );
                return response()->json($response->toArray());
            }

            $observaciones = $datos['observaciones'] ? $datos['observaciones'] : '';
            $referencia = $datos['referencia'] ? $datos['referencia'] : '';

            $ajusteBD->observaciones = $observaciones;
            $ajusteBD->referencia = $referencia;
            $ajusteBD->save();

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
