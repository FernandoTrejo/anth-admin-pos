<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\StatusTraslados;

class ConsultarTrasladosController extends Controller
{
    public function ConsultarTodos()
    {
        try {
            $traslados = Traslado::with('productos')->get()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Traslados",
                [
                    'traslados' => $traslados
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


    public function ConsultarTrasladosHaciaMiSucursal($claveCentroCosto, $estado)
    {
        try {
            $traslados = [];

            switch ($estado) {
                case StatusTraslados::$Inicial:
                    $traslados = Traslado::where('codigo_destino', $claveCentroCosto)->where('status', StatusTraslados::$Inicial)->with('productos')->get()->toArray();
                    break;
                case StatusTraslados::$Finalizado:
                    $traslados = Traslado::where('codigo_destino', $claveCentroCosto)->where('status', StatusTraslados::$Finalizado)->with('productos')->get()->toArray();
                    break;
                case StatusTraslados::$Cancelado:
                    $traslados = Traslado::where('codigo_destino', $claveCentroCosto)->where('status', StatusTraslados::$Cancelado)->with('productos')->get()->toArray();
                    break;

                default:
                    $traslados = Traslado::where('codigo_destino', $claveCentroCosto)->with('productos')->get()->toArray();
                    break;
            }


            $response =  new APIResponse(
                200,
                true,
                "Traslados Hacia Sucursal",
                [
                    'traslados' => $traslados
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
