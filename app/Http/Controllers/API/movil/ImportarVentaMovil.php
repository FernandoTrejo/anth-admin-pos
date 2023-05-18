<?php

namespace App\Http\Controllers\API\movil;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\VentaMovil;
use App\Models\VentaMovilProducto;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class ImportarVentaMovil extends Controller
{
    public function importar(Request $request)
    {
        try {
            $caja = Caja::where('codigo', $request['codigo_caja'])->first();
            if(!$caja){
                $response = new APIResponse(404, false, 'No existe codigo de caja especificada', []);
                return response()->json($response->toArray());
            }

            DB::transaction(function () use ($request, $caja) {
                $timestamp = $request['fechaISO'];
                $date = new DateTime();
                $date->setTimestamp($timestamp / 1000);
                VentaMovil::create([
                    'codigo' => $request['codigo'],
                    'fecha' => $date,
                    'nombre_cliente' => $request['nombre_cliente'],
                    'total' => $request['total'],
                    'status' => $request['status'],
                    'codigo_vendedor' => $request['codigo_vendedor'],
                    'codigo_caja' => $request['codigo_caja'],
                    'codigo_sucursal' => $request['codigo_sucursal'],
                    'codigo_usuario' => $request['codigo_usuario'],
                    'caja_id'   => $caja->id,
                    'iva'  => $request['iva']
                ]);
        
                $productos = $request['productos_orden'];
                foreach ($productos as $productoOrden) {
                    VentaMovilProducto::create([
                        'codigo_producto' => $productoOrden['codigo_producto'],
                        'nombre_producto' => $productoOrden['nombre_producto'],
                        'precio' => $productoOrden['precio'],
                        'costo' => $productoOrden['costo'],
                        'cantidad' => $productoOrden['cantidad'],
                        'subtotal' => $productoOrden['subtotal'],
                        'porcentaje_descuento' => $productoOrden['porcentaje_descuento'],
                        'valor_descuento' => $productoOrden['valor_descuento'],
                        'precio_sin_descuento' => $productoOrden['precio_sin_descuento'],
                        'codigo_orden' => $productoOrden['codigo_orden'],
                        'codigo_corte_x' => $productoOrden['codigo_corte_x'],
                        'iva' => $productoOrden['iva'],
                        'motivo_descuento' => $productoOrden['motivo_descuento'],
                    ]);
                }
            });
            $response = new APIResponse(200, true, 'La orden de venta se ha guardado correctamente', []);
            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse($th->getCode(), false, $th->getMessage(), []);
            return response()->json($response->toArray());
        }
    }
}
