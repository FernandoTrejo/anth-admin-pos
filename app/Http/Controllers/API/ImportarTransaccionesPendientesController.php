<?php

namespace App\Http\Controllers\API;

use App\Events\InventarioModificado;
use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Sucursal;
use App\Models\Transaccion;
use App\Models\TransaccionPago;
use App\Models\TransaccionProducto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;
use Src\shared\DTOs\TransaccionDTO;
use Src\shared\Parsers\PagoParser;
use Src\shared\Parsers\TransaccionParser;
use Src\shared\Parsers\TransaccionProductoParser;

class ImportarTransaccionesPendientesController extends Controller
{
    public function Importar(Request $request){
        $codigosRegistrados = [];
        try {
            $datos = $request->all();
            $transacciones = $datos['transacciones'];
            $claveSucursal = $datos['clave_sucursal'];
            $claveCaja = $datos['clave_caja'];

            $sucursal = Sucursal::where('codigo', $claveSucursal)->first();
            if(!$sucursal){
                throw new Exception("No existe la sucursal con clave $claveSucursal");
            }

            $caja = Caja::where('codigo', $claveCaja)->first();
            if(!$caja){
                throw new Exception("No existe la caja con clave $claveCaja");
            }

            $parser = new TransaccionParser();
            foreach($transacciones as $transaccionDatos){
                $transaccionDatos['caja_id'] = $caja->id;
                $transaccionDatos['codigo_caja'] = $caja->codigo;
                $transaccionDatos['codigo_sucursal'] = $sucursal->codigo;
                $transaccionDTO = $parser->parse($transaccionDatos);
                
                if(!$this->existeCodigoTransaccion($transaccionDTO->codigo)){
                    if(!$this->InsertarInfoTransaccion($transaccionDTO)){
                        continue;
                    }
                }

                $codigosRegistrados[] = $transaccionDTO->codigo;
            }


            $response =  new APIResponse(
                200,
                true,
                "Transacciones Sincronizadas",
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

    private function existeCodigoTransaccion($codigo) : bool{
        $transaccion = Transaccion::where('codigo', $codigo)->first();
        if(!$transaccion){
            return false;
        }
        return true;
    }

    private function InsertarInfoTransaccion($transaccionDTO) : bool{
        try {
            DB::transaction(function () use ($transaccionDTO){
                $originalArr = $transaccionDTO->toArray();
                $copy = $transaccionDTO->toArray();
                unset($copy['pagos']);
                unset($copy['productos_orden']);
                Transaccion::create($copy);

                $pagosArr = $originalArr['pagos'];
                $productosOrdenArr = $originalArr['productos_orden'];

                $pagosInsert = PagoParser::parseManyToArray($pagosArr);
                TransaccionPago::insert($pagosInsert);

                $productosInsert = TransaccionProductoParser::parseManyToArray($productosOrdenArr);
                TransaccionProducto::insert($productosInsert);

                if(count($productosInsert) > 0){
                    // InventarioModificado::dispatch(
                    //     $originalArr['codigo_sucursal'],
                    //     $originalArr['codigo_caja'],
                    //     $productosInsert,
                    // );
                }   
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

}
