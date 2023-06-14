<?php

namespace App\Http\Controllers\API\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Src\shared\APIResponse;
use Src\shared\Parsers\ClienteParser;

class ImportarClientesController extends Controller
{
    public function Importar(Request $request){
        $codigosRegistrados = [];
        try {
            $datos = $request->all();
            $clientes = $datos['clientes'];
            $parser = new ClienteParser();
            foreach($clientes as $clienteDatos){
                $clienteDTO = $parser->parse($clienteDatos);
                
                if(!$this->existeCodigoCliente($clienteDTO->codigo)){
                    if(!$this->InsertarInfoCliente($clienteDTO)){
                        continue;
                    }
                }else{
                    if(!$this->ActualizarInfoCliente($clienteDTO)){
                        continue;
                    }
                }

                $codigosRegistrados[] = $clienteDTO->codigo;
            }


            $response =  new APIResponse(
                200,
                true,
                "Clientes Sincronizados",
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

    private function existeCodigoCliente($codigo) : bool{
        $cliente = Cliente::where('codigo', $codigo)->first();
        if(!$cliente){
            return false;
        }
        return true;
    }

    private function InsertarInfoCliente($clienteDTO) : bool{
        try {
            DB::transaction(function () use ($clienteDTO){
                $clienteCreado = Cliente::create($clienteDTO->toArray());
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    private function ActualizarInfoCliente($clienteDTO) : bool{
        try {
            DB::transaction(function () use ($clienteDTO){
                Cliente::where('codigo', $clienteDTO->codigo)->update($clienteDTO->toArray());
            });
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}
