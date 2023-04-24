<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use Illuminate\Http\Request;
use Src\shared\APIResponse;

class ConsultarInfoCajasController extends Controller
{
    public function ConsultarInfoCaja($codigo){
        try {
            $caja = Caja::where('codigo', $codigo)->with('numeradores')->first()->toArray();

            $response =  new APIResponse(
                200,
                true,
                "Caja",
                [
                    'caja' => $caja
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
