<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Sucursal;
use App\Models\Transformacion;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;

class ImportarTransformacionesProductosController extends Controller
{
    public function Importar(Request $request)
    {
        $codigosRegistrados = [];
        try {
            $datos = $request->all();
            $transformacion = $datos['transformacion'];
            $claveSucursal = $datos['clave_sucursal'];
            $claveCaja = $datos['clave_caja'];

            $sucursal = Sucursal::where('codigo', $claveSucursal)->first();
            if (!$sucursal) {
                throw new Exception("No existe la sucursal con clave $claveSucursal");
            }

            $caja = Caja::where('codigo', $claveCaja)->first();
            if (!$caja) {
                throw new Exception("No existe la caja con clave $claveCaja");
            }

            $date = new DateTime();
            $date->setTimestamp($transformacion['timestamp_creacion'] / 1000);
            $tDatos = [
                'codigo_caja' => $caja->codigo,
                'codigo_sucursal' => $sucursal->codigo,
                'uuid' => $transformacion['uuid'],
                'fecha' => $date,
                'codigo_usuario' => $transformacion['codigo_usuario'],
                'codigo_producto_origen' => $transformacion['codigo_producto_origen'],
                'cantidad_producto_origen' => $transformacion['cantidad_producto_origen'],
                'costo_producto_origen' => $transformacion['costo_producto_origen'],
                'codigo_producto_destino' => $transformacion['codigo_producto_destino'],
                'cantidad_producto_destino' => $transformacion['cantidad_producto_destino'],
                'costo_producto_destino' => $transformacion['costo_producto_destino'],
                'descripcion' => $transformacion['descripcion'] ? $transformacion['descripcion'] : '',
            ];

            if (!$this->existeCodigoTransformacion($transformacion['uuid'])) {
                if (!$this->InsertarInfoTransformacion($tDatos)) {
                } else {
                    $codigosRegistrados[] = $tDatos['uuid'];
                }
            } else {
                if (!$this->ActualizarInfoTransformacion($tDatos)) {
                } else {
                    $codigosRegistrados[] = $tDatos['uuid'];
                }
            }

            $response =  new APIResponse(
                200,
                true,
                "Transformaciones Sincronizadas",
                ["codigos_registrados" => $codigosRegistrados]
            );

            return response()->json($response->toArray());
        } catch (\Throwable $th) {
            $response = new APIResponse(
                $th->getCode(),
                false,
                $th->getMessage(),
                ["codigos_registrados" => $codigosRegistrados]
            );
            return response()->json($response->toArray());
        }
    }

    private function existeCodigoTransformacion($codigo) : bool{
        $t = Transformacion::where('uuid', $codigo)->first();
        if(!$t){
            return false;
        }
        return true;
    }

    private function InsertarInfoTransformacion($tDatos) : bool{
        try {
            DB::transaction(function () use ($tDatos){
                Transformacion::create($tDatos);
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    private function ActualizarInfoTransformacion($tDatos) : bool{//unicamente datos de la transaccion, se excluyen pagos y productos contenidos en dicha orden
        try {
            DB::transaction(function () use ($tDatos){
                Transformacion::where('uuid', $tDatos['uuid'])->update($tDatos);
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}
