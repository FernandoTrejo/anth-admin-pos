<?php

namespace App\Http\Controllers\API\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class VentaDiariaController extends Controller
{
    public function Consultar(Request $request){
        try {
            $datos = $request->all();
            $fechaInicio = $datos['init_date'];
            $fechaFin = $datos['final_date'];//YYYY-MM-DD
            $ventasDiarias = DB::select("CALL x_ObtenerVentasPorFecha(?,?)", [$fechaInicio, $fechaFin]);
            $response = new APIResponse(200, true, 'OK', [
                'ventas' => $ventasDiarias
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
