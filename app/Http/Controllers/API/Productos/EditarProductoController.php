<?php

namespace App\Http\Controllers\API\Productos;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class EditarProductoController extends Controller
{
    public function Guardar(Request $request)
    {
        try {
            $datos = $request->all();

            $producto = Producto::where('codigo', $datos['codigo'])->first();
            if (!$producto) {
                $response =  new APIResponse(
                    404,
                    false,
                    "El codigo no existe",
                    []
                );

                return response()->json($response->toArray());
            }

            Producto::where('codigo', $datos['codigo'])->update([
                'nombre' => $datos['nombre'],
                'modelo' => $datos['modelo'],
                'upc' => $datos['upc'],
                'linea_codigo' => $datos['linea_codigo'],
                'unidad_medida' => $datos['unidad_medida'],
                'precio' => $datos['precio'],
                'status' => $datos['status'],
                'proveedor' => $datos['proveedor'],
                'permitir_venta' => $datos['permitir_venta'],
                'permitir_traslado' => $datos['permitir_traslado'],
                'permitir_ajuste' => $datos['permitir_ajuste'],
                'permitir_cambio_precio_caja' => $datos['permitir_cambio_precio_caja'],
                'permitir_cambio_nombre_caja' => $datos['permitir_cambio_nombre_caja'],
                'controlar_existencias' => $datos['controlar_existencias'],
                'costo_promedio' => $datos['costo_promedio'],
            ]);
            
            $response =  new APIResponse(
                200,
                true,
                "Se ha guardado la informacion",
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
