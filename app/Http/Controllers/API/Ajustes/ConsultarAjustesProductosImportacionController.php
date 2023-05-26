<?php

namespace App\Http\Controllers\API\Ajustes;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarAjustesProductosImportacionController extends Controller
{
    public function Consultar(Request $request)
    {
        try {
            $datos = $request->toArray();
            $productos = $datos['productos'];
            $ajusteID = $datos['adjustmentID'];

            $codigosConFallos = [];
            $ajusteProductos = [];

            foreach ($productos as $producto) {
                $productoBD = Producto::where('codigo', trim($producto['codigo']))->first();

                if (!$productoBD) {
                    $codigosConFallos[] = trim($producto['codigo']);
                } else {
                    $ajusteProducto = [
                        'codigo_producto' => $productoBD->codigo,
                        'cantidad' => $producto['cantidad'],
                        'costo_unitario' => $productoBD->costo_promedio,
                        'costo_total' => $producto['cantidad'] * $productoBD->costo_promedio,
                        'ajuste_id' => $ajusteID,
                        'nombre_producto' => $productoBD->nombre
                    ];
                    $ajusteProductos[] = $ajusteProducto; 
                }
            }

            $response =  new APIResponse(
                200,
                true,
                "Ajuste Productos",
                [
                    "productos" => $ajusteProductos,
                    "codigos_error" => $codigosConFallos
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
