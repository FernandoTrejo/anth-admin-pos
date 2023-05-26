<?php

namespace App\Http\Controllers\API\Ajustes;

use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use App\Models\AjusteProducto;
use App\Models\Kardex;
use App\Models\Sucursal;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;
use Src\shared\TipoAjuste;
use Src\shared\TipoMovimientosKardex;
use Src\shared\TipoTransacciones;
use Illuminate\Support\Str;
use Src\shared\StatusActivo;
use Src\shared\StatusAjuste;

class FinalizarAjusteController extends Controller
{
    public function Finalizar(Request $request)
    {

        try {
            $datos = $request->toArray();
            $productos = $datos['productos'];
            $productosInsertar = [];
            $ajusteID = 0;
            foreach ($productos as $producto) {
                $productosInsertar[] = [
                    'codigo_producto' => $producto['codigo_producto'],
                    'cantidad' => $producto['cantidad'],
                    'costo_unitario' => $producto['costo_unitario'],
                    'costo_total' => $producto['costo_total'],
                    'ajuste_id' => $producto['ajuste_id'],
                ];
                $ajusteID = $producto['ajuste_id'];
            }
            // return response()->json($productosInsertar);

            $ajuste = Ajuste::find($ajusteID);
            if (!$ajuste) {
                $response =  new APIResponse(
                    404,
                    false,
                    "No existe el ajuste solicitado",
                    []
                );
                return response()->json($response->toArray());
            }

            $registrosKardex = $this->PrepararRegistrosKardex($productosInsertar, $ajuste);
            $this->InsertarInformacion($productosInsertar, $registrosKardex, $ajuste);

            $response =  new APIResponse(
                200,
                true,
                "Ajuste Finalizado con Exito",
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

    private function InsertarInformacion($productosInsertar, $registrosKardex, $ajuste)
    {
        try {
            DB::transaction(function () use ($productosInsertar, $registrosKardex, $ajuste) {
                AjusteProducto::insert($productosInsertar);
                Kardex::insert($registrosKardex);
                $ajuste->status = StatusAjuste::$Closed;
                $ajuste->save();
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    private function PrepararRegistrosKardex($productosInsertar, $ajuste)
    {
        $sucursal = Sucursal::where('codigo', $ajuste->codigo_sucursal)->first();
        $tipoMovimientoKardex = ($ajuste->tipo === TipoAjuste::$AFavor) ? TipoMovimientosKardex::$Entrada : TipoMovimientosKardex::$Salida;
        $tipoTransaccion = ($ajuste->tipo === TipoAjuste::$AFavor) ? TipoTransacciones::$AjusteAFavor : TipoTransacciones::$AjusteEnContra;

        $registros = [];

        foreach ($productosInsertar as $prodInsertar) {
            $registros[] = [
                'codigo' => Str::uuid(),
                'fecha_hora' => new DateTime(),
                'codigo_producto' => $prodInsertar['codigo_producto'],
                'cantidad' => $prodInsertar['cantidad'],
                'costo' => $prodInsertar['costo_unitario'],
                'precio' => 0, //campo inservible
                'precio_sin_descuento' => 0, //campo inservible
                'tipo_movimiento' => $tipoMovimientoKardex,
                'numero_documento' => $ajuste->numero,
                'status' => StatusActivo::$Activo,
                'codigo_orden' => $ajuste->id, //id del ajuste
                'centro_costo' => $sucursal->clave_centro_costo,
                'clave_sucursal' => $ajuste->codigo_sucursal,
                'clave_caja' => 'N/A',
                'proveedor_cliente' => '',
                'tipo_transaccion' => $tipoTransaccion,
            ];
        }

        return $registros;
    }
}
