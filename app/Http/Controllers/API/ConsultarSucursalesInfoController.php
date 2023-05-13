<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarSucursalesInfoController extends Controller
{
    public function ConsultarTodas(){
        try {
            $sucursales = Sucursal::all()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Sucursales",
                [
                    'sucursales' => $sucursales
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


    public function ConsultarInfoSucursal($codigo){
        try {
            $sucursal = Sucursal::where('codigo', $codigo)->with('formasPago')->with('cajas')->first()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Sucursal",
                [
                    'sucursal' => $sucursal
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
