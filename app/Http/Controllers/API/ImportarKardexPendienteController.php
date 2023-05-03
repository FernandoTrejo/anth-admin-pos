<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Kardex;
use App\Models\Sucursal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;
use Src\shared\Parsers\KardexParser;

class ImportarKardexPendienteController extends Controller
{
    public function Importar(Request $request){
        $codigosRegistrados = [];
        try {
            $datos = $request->all();
            $kardexSet = $datos['kardex_set'];
            $claveSucursal = $datos['clave_sucursal'];
            $claveCaja = $datos['clave_caja'];
            $centroCosto = $datos['centro_costo'];

            $sucursal = Sucursal::where('codigo', $claveSucursal)->first();
            if(!$sucursal){
                throw new Exception("No existe la sucursal con clave $claveSucursal");
            }

            $caja = Caja::where('codigo', $claveCaja)->first();
            if(!$caja){
                throw new Exception("No existe la caja con clave $claveCaja");
            }

            $parser = new KardexParser();
            foreach($kardexSet as $kardexDatos){
                
                $kardexDatos['centro_costo'] = $centroCosto;
                $kardexDatos['codigo_caja'] = $caja->codigo;
                $kardexDatos['codigo_sucursal'] = $sucursal->codigo;
                $kardexDTO = $parser->parse($kardexDatos);
                
                if(!$this->existeCodigoKardex($kardexDTO->codigo)){
                    if(!$this->InsertarInfoKardex($kardexDTO)){
                        continue;
                    }
                }else{
                    if(!$this->ActualizarInfoKardex($kardexDTO)){
                        continue;
                    }
                }

                $codigosRegistrados[] = $kardexDTO->codigo;
            }


            $response =  new APIResponse(
                200,
                true,
                "Kardex Sincronizados",
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

    private function existeCodigoKardex($codigo) : bool{
        $item = Kardex::where('codigo', $codigo)->first();
        if(!$item){
            return false;
        }
        return true;
    }

    private function InsertarInfoKardex($infoDTO) : bool{
        try {
            DB::transaction(function () use ($infoDTO){
                Kardex::create($infoDTO->toArray());
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    private function ActualizarInfoKardex($infoDTO) : bool{
        try {
            DB::transaction(function () use ($infoDTO){
                Kardex::where('codigo', $infoDTO->codigo)->update($infoDTO->toArray());
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}
