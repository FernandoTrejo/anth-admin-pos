<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Corte;
use App\Models\CorteMontoAsignado;
use App\Models\Sucursal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;
use Src\shared\Parsers\CorteMontoParser;
use Src\shared\Parsers\CorteParser;

class ImportarCortesPendientesController extends Controller
{
    public function Importar(Request $request){
        $codigosRegistrados = [];
        try {
            $datos = $request->all();
            $cortes = $datos['cortes'];
            $claveSucursal = $datos['codigo_sucursal'];
            $claveCaja = $datos['codigo_caja'];

            $sucursal = Sucursal::where('codigo', $claveSucursal)->first();
            if(!$sucursal){
                throw new Exception("No existe la sucursal con clave $claveSucursal");
            }

            $caja = Caja::where('codigo', $claveCaja)->first();
            if(!$caja){
                throw new Exception("No existe la caja con clave $claveCaja");
            }

            $parser = new CorteParser();
            foreach($cortes as $corteDatos){
                $corteDatos['codigo_caja'] = $caja->codigo;
                $corteDatos['codigo_sucursal'] = $sucursal->codigo;
                $corteDTO = $parser->parse($corteDatos);
                
                if(!$this->existeCodigoCorte($corteDTO->codigo)){
                    if(!$this->InsertarInfoCorte($corteDTO)){
                        continue;
                    }
                }else{
                    if(!$this->ActualizarInfoCorte($corteDTO)){
                        continue;
                    }
                }

                $codigosRegistrados[] = $corteDTO->codigo;
            }


            $response =  new APIResponse(
                200,
                true,
                "Cortes Sincronizados",
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

    private function existeCodigoCorte($codigo) : bool{
        $corte = Corte::where('codigo', $codigo)->first();
        if(!$corte){
            return false;
        }
        return true;
    }

    private function InsertarInfoCorte($corteDTO) : bool{
        try {
            DB::transaction(function () use ($corteDTO){
                $originalArr = $corteDTO->toArray();
                $copy = $corteDTO->toArray();
                unset($copy['montos']);
                $corteCreado = Corte::create($copy);

                $montosArr = $originalArr['montos'];
                $nuevoMontosArr = array_map(function($item) use ($corteCreado){
                    $item['corte_id'] = $corteCreado->id;
                    return $item;
                }, $montosArr);
                $montosInsert = CorteMontoParser::parseManyToArray($nuevoMontosArr);
                CorteMontoAsignado::insert($montosInsert);

            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    private function ActualizarInfoCorte($corteDTO) : bool{//unicamente datos de la transaccion, se excluyen pagos y productos contenidos en dicha orden
        try {
            DB::transaction(function () use ($corteDTO){
                
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}
