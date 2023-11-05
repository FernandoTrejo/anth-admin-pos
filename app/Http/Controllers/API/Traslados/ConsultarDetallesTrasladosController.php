<?php

namespace App\Http\Controllers\API\Traslados;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Traslado;
use App\Models\TrasladoProducto;
use App\Models\UsuarioPOS;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarDetallesTrasladosController extends Controller
{
    public function Consultar($codigo)
    {
        try {
            $traslado = Traslado::where('uuid', $codigo)->first();
            if (!$traslado) {
                $response =  new APIResponse(
                    404,
                    false,
                    "EL traslado no existe",
                    []
                );
                return response()->json($response->toArray());
            }

            $usuarios = [];
            if($traslado->codigo_usuario_envia){
                $usuarioEnvia = UsuarioPOS::where('codigo', $traslado->codigo_usuario_envia)->first();
                $usuarios['nombre_usuario_envia'] = (!$usuarioEnvia) ? '' : $usuarioEnvia->nombre_empleado;
            }
            if($traslado->codigo_usuario_recibe){
                $usuarioRecibe = UsuarioPOS::where('codigo', $traslado->codigo_usuario_recibe)->first();
                $usuarios['nombre_usuario_recibe'] = (!$usuarioRecibe) ? '' : $usuarioRecibe->nombre_empleado;
            }
            if($traslado->codigo_usuario_rechaza){
                $usuarioRechaza = UsuarioPOS::where('codigo', $traslado->codigo_usuario_rechaza)->first();
                $usuarios['nombre_usuario_rechaza'] = (!$usuarioRechaza) ? '' : $usuarioRechaza->nombre_empleado;
            }

            $productos = TrasladoProducto::where('traslado_id', $traslado->id)->get();
            $productosArr = array_map(function($item){
                $prod = Producto::where('codigo', $item['codigo_producto'])->first();
                $nombre = (!$prod) ? '' : $prod->nombre;
                $item['nombre_producto'] = $nombre;
                return $item;
            }, $productos->toArray());
            $response =  new APIResponse(
                200,
                true,
                "Detalles de transaccion",
                [
                    'traslado' => array_merge($traslado->toArray(), $usuarios),
                    'productos' => $productosArr
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
