<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use Carbon\Carbon;
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
                    $traslados = Traslado::where('centro_costo_destino', $claveCentroCosto)->where('status', StatusTraslados::$Inicial)->with('productos')->get()->toArray();
                    break;
                case StatusTraslados::$Finalizado:
                    $traslados = Traslado::where('centro_costo_destino', $claveCentroCosto)->where('status', StatusTraslados::$Finalizado)->with('productos')->get()->toArray();
                    break;
                case StatusTraslados::$Cancelado:
                    $traslados = Traslado::where('centro_costo_destino', $claveCentroCosto)->where('status', StatusTraslados::$Cancelado)->with('productos')->get()->toArray();
                    break;

                default:
                    $traslados = Traslado::where('centro_costo_destino', $claveCentroCosto)->with('productos')->get()->toArray();
                    break;
            }

            $traslados = array_map(function($t){
                $t['fecha_envio_timestamp'] = strtotime($t['fecha_envio']);
                $t['fecha_recepcion_timestamp'] = strtotime($t['fecha_recepcion_sucursal']);
                $t['fecha_declinacion_timestamp'] = strtotime($t['fecha_declinacion_sucursal']);
                return $t;
            }, $traslados);

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


    public function ConsultarUltimosTrasladosHaciaMiSucursal($claveCentroCosto, $limit = 10)
    {
        try {
            $traslados = [];

            $traslados = Traslado::where('centro_costo_destino', $claveCentroCosto)->with('productos')->orderBy('updated_at', 'desc')->skip(0)->take($limit)->get()->toArray();

            $traslados = array_map(function($t){
                $t['fecha_envio_timestamp'] = strtotime($t['fecha_envio']);
                $t['fecha_recepcion_timestamp'] = strtotime($t['fecha_recepcion_sucursal']);
                $t['fecha_declinacion_timestamp'] = strtotime($t['fecha_declinacion_sucursal']);
                return $t;
            }, $traslados);

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


    public function ConsultarUltimosTrasladosModificados($claveCentroCosto){
        try {
            $traslados = [];
            $firstDate = Carbon::now()->subDays(5);
            $tomorrow = Carbon::tomorrow();
            $trasladosRecibidos = Traslado::where('centro_costo_destino', $claveCentroCosto)->whereBetween('updated_at', [$firstDate, $tomorrow])->with('productos')->get()->toArray();
            $trasladosEnviados = Traslado::where('centro_costo_origen', $claveCentroCosto)->whereBetween('updated_at', [$firstDate, $tomorrow])->with('productos')->get()->toArray();

            $traslados = array_merge($trasladosEnviados, $trasladosRecibidos);

            $traslados = array_map(function($t){
                $t['fecha_envio_timestamp'] = strtotime($t['fecha_envio']);
                $t['fecha_recepcion_timestamp'] = strtotime($t['fecha_recepcion_sucursal']);
                $t['fecha_declinacion_timestamp'] = strtotime($t['fecha_declinacion_sucursal']);
                return $t;
            }, $traslados);

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
