<?php

namespace App\Http\Controllers\API\Ajustes;

use App\Http\Controllers\Controller;
use App\Models\Ajuste;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarInfoAjusteController extends Controller
{
    public function Consultar($id)
    {
        try {
            $ajusteBD = Ajuste::where('id', $id)->with('productos')->first();
            if (!$ajusteBD) {
                $response = new APIResponse(
                    404,
                    false,
                    'No existe el ajuste solicitado',
                    []
                );
                return response()->json($response->toArray());
            }

            $ajuste = $ajusteBD->toArray();

            $ajuste['fecha_timestamp'] = strtotime($ajuste['fecha']);
            $suc = Sucursal::where('codigo', $ajuste['codigo_sucursal'])->first();
            $ajuste['nombre_sucursal'] = $suc->nombre;
            $ajuste['fecha_autorizacion_timestamp'] = $ajuste['fecha_autorizacion'] ? strtotime($ajuste['fecha_autorizacion']) : null;
            $ajuste['fecha_denegado_timestamp'] = $ajuste['fecha_denegado'] ? strtotime($ajuste['fecha_denegado']) : null;
            
            $ajuste['nombre_usuario_rechaza'] = $this->obtenerNombreUsuario($ajuste, 'codigo_usuario_rechaza');
            $ajuste['nombre_usuario_autoriza'] = $this->obtenerNombreUsuario($ajuste, 'codigo_usuario_autoriza');

            foreach($ajuste['productos'] as $producto){
                

            }
            $ajuste['productos'] = array_map(function($producto){
                $productoBD = Producto::where('codigo', $producto['codigo_producto'])->first();
                if(!$productoBD){
                    return $producto;
                }
                $producto['nombre_producto'] = $productoBD->nombre;
                return $producto;
            }, $ajuste['productos']);


            $response =  new APIResponse(
                200,
                true,
                "Ajuste",
                [
                    "ajuste" => $ajuste
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

    private function obtenerNombreUsuario($ajuste, $index){
        if(!$ajuste[$index]){
            return '';
        }

        $user = User::where('username', $ajuste[$index])->first();

        if(!$user){
            return '';
        }

        return $user->name;
    }
}
