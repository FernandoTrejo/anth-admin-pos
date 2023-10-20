<?php

namespace App\Http\Controllers\API\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class VentaDiariaProductoSucursalController extends Controller
{
    public function Consultar(Request $request){
        try {
            $datos = $request->all();
            $fechaInicio = $datos['init_date'];
            $fechaFin = $datos['final_date'];//YYYY-MM-DD
            $codigoProducto = $datos['product_code'];

            $prod = Producto::where('codigo', $codigoProducto)->first();
            if(!$prod){
                $response = new APIResponse(404, false, 'No existe el codigo de producto solicitado', []);
                return response()->json($response->toArray());
            }

            $sucursalesLista = $datos['stores_list'];
            $ventasProducto = DB::select("CALL x_BuscarVentasPorProducto(?,?,?,?)", [$codigoProducto, $sucursalesLista, $fechaInicio, $fechaFin]);
            $response = new APIResponse(200, true, 'OK', [
                'ventas' => $ventasProducto,
                'producto' => $prod->toArray()
            ]);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
