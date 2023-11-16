<?php

namespace App\Http\Controllers\API\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class VentasRangoProductosController extends Controller
{
    public function Consultar(Request $request){
        try {
            $datos = $request->all();
            $fechaInicio = $datos['init_date'];
            $fechaFin = $datos['final_date'];//YYYY-MM-DD
            $productosLista = $datos['products_list'];
            $sucursalesLista = $datos['stores_list'];
            $reporte = DB::select("CALL x_BuscarVentasRangoProductos(?,?,?,?)", [$productosLista, $sucursalesLista, $fechaInicio, $fechaFin]);
            $response = new APIResponse(200, true, 'OK', [
                'reporte' => $reporte
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
