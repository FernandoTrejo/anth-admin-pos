<?php

namespace App\Http\Controllers\API\Ajustes;

use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarAjustesPorStatusController extends Controller
{
    public function Consultar($status_ajuste, $skip, $take){
        try {
            $totalItems = Ajuste::where('status', $status_ajuste)->count();
            $ajustes = Ajuste::where('status', $status_ajuste)->skip($skip)->take($take)->orderBy('fecha', 'desc')->get()->toArray();
            $ajustes = array_map(function($ajuste){
                $ajuste['fecha_timestamp'] = strtotime($ajuste['fecha']);
                $suc = Sucursal::where('codigo', $ajuste['codigo_sucursal'])->first();
                $ajuste['nombre_sucursal'] = $suc->nombre;
                return $ajuste;
            }, $ajustes);
            $response =  new APIResponse(
                200,
                true,
                "Ajustes",
                [
                    "ajustes" => $ajustes,
                    "total_items" => $totalItems
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
