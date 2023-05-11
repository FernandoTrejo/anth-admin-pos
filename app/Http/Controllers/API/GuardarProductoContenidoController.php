<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\ProductoContenido;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\DTOs\ProductoContenidoDTO;
use Src\shared\Parsers\ProductoContenidoParser;
use Src\shared\SiNoStatus;

class GuardarProductoContenidoController extends Controller
{

    public function Guardar(Request $request){
        try {
            $datos = $request->all();
            $datosProductoContenido = $datos['producto_contenido'];
            $parser = new ProductoContenidoParser();
            $productoDTO = $parser->parse($datosProductoContenido);

            $itemCreado = ProductoContenido::create($productoDTO->toArray());
            Producto::where('id', $productoDTO->producto_id)->update(
                [
                    'contiene_productos' => SiNoStatus::$Si
                ]
            );

            $response =  new APIResponse(
                200,
                true,
                "Se ha guardado la informacion",
                [
                    'id' => $itemCreado->id
                ]
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
