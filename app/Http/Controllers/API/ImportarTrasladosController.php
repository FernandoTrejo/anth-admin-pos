<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\Sucursal;
use App\Models\Transaccion;
use App\Models\TransaccionPago;
use App\Models\TransaccionProducto;
use App\Models\Traslado;
use App\Models\TrasladoProducto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;
use Src\shared\Parsers\TrasladoParser;
use Src\shared\Parsers\TrasladoProductoParser;

class ImportarTrasladosController extends Controller
{
    public function Importar(Request $request){
        $codigosRegistrados = [];
        try {
            $datos = $request->all();
            $traslados = $datos['traslados'];
            $parser = new TrasladoParser();
            foreach($traslados as $trasladoDatos){
                $trasladoDTO = $parser->parse($trasladoDatos);
                
                if(!$this->existeCodigoTraslado($trasladoDTO->uuid)){
                    if(!$this->InsertarInfoTraslado($trasladoDTO)){
                        continue;
                    }
                }else{
                    if(!$this->ActualizarInfoTraslado($trasladoDTO)){
                        continue;
                    }
                }

                $codigosRegistrados[] = $trasladoDTO->uuid;
            }


            $response =  new APIResponse(
                200,
                true,
                "Traslados Sincronizados",
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

    private function existeCodigoTraslado($codigo) : bool{
        $traslado = Traslado::where('uuid', $codigo)->first();
        if(!$traslado){
            return false;
        }
        return true;
    }

    private function InsertarInfoTraslado($trasladoDTO) : bool{
        try {
            DB::transaction(function () use ($trasladoDTO){
                $originalArr = $trasladoDTO->toArray();
                $copy = $trasladoDTO->toArray();
                unset($copy['productos']);
                $trasladoCreado = Traslado::create($copy);

                $productosArr = $originalArr['productos'];
                $productosArr = array_map(function($item) use ($trasladoCreado){
                    $item['traslado_id'] = $trasladoCreado->id;
                    return $item;
                }, $productosArr);
                $productosInsert = TrasladoProductoParser::parseManyToArray($productosArr);
                TrasladoProducto::insert($productosInsert);  
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    private function ActualizarInfoTraslado($trasladoDTO) : bool{
        try {
            DB::transaction(function () use ($trasladoDTO){
                $originalArr = $trasladoDTO->toArray();
                $copy = $trasladoDTO->toArray();
                unset($copy['productos']);
                Traslado::where('uuid', $trasladoDTO->uuid)->update($copy);
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}
