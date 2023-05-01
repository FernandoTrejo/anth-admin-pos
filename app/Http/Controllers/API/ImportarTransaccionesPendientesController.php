<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Sucursal;
use App\Models\Transaccion;
use Exception;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\DTOs\TransaccionDTO;
use Src\shared\Parsers\TransaccionParser;

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
                $transaccionDatos['codigo_usuario'] = '';
                $transaccionDTO = $parser->parse($transaccionDatos);
                
                if(!$this->existeCodigoTransaccion($transaccionDTO->codigo)){
                    Transaccion::create($transaccionDTO->toArray());
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

}
