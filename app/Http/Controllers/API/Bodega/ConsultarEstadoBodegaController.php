<?php

namespace App\Http\Controllers\API\Bodega;

use App\Http\Controllers\Controller;
use App\Models\BodegaProducto;
use App\Models\Kardex;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\Utils\DateParser;

class ConsultarEstadoBodegaController extends Controller
{
    public function Consultar(Request $request){
        try {
            $datos = $request->toArray();

            $clave_sucursal = $datos['clave_sucursal'];
            $date = DateParser::FromJSDateObject($datos['date_timestamp']);
            $finalDate = $date->format('Y-m-d');

            $productos = BodegaProducto::where('fecha',  $finalDate)->where('clave_sucursal', $clave_sucursal)->get();
            $kardex = Kardex::whereBetween('fecha_hora', [$finalDate, $date])->where('clave_sucursal', $clave_sucursal)->get();
            $response = new APIResponse(200, true, 'Info Bodega', [
                'productos' => $productos->toArray(),
                'kardex' => $kardex->toArray()
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
