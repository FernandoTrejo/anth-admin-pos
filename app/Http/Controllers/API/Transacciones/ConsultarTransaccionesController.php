<?php

namespace App\Http\Controllers\API\Transacciones;

use App\Http\Controllers\Controller;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\FilterType;
use Src\shared\Utils\FilterTransformer;
use Src\shared\Utils\LimiterTransformer;
use Src\shared\Utils\SearchFilter;
use Src\shared\Utils\SorterTransformer;

class ConsultarTransaccionesController extends Controller
{
    protected $filterKeys = [];
    public function __construct()
    {
        $this->filterKeys = [
            'codigo' => FilterType::$Text,
            'numero_transaccion' => FilterType::$Text,
            'fecha' => FilterType::$Date,
            'nombre_cliente' => FilterType::$Text,
            'codigo_cliente' => FilterType::$Text,
            'total' => FilterType::$Numeric,
            'status' => FilterType::$Text,
            'corte_mensual' => FilterType::$Text,
            'corte_diario' => FilterType::$Text,
            'corte_parcial' => FilterType::$Text,
            'tipo_documento_clave' => FilterType::$Text,
            'forma_pago' => FilterType::$Text,
            'referencia' => FilterType::$Text,
            'codigo_vendedor' => FilterType::$Text,
            'codigo_caja' => FilterType::$Text,
            'codigo_sucursal' => FilterType::$Text,
            'codigo_usuario' => FilterType::$Text,
            'tipo_transaccion' => FilterType::$Text
        ];
    }

    public function ConsultarTransacciones(Request $request)
    {
        try {
            $filtersRequest = $request->get('filters') ? $request->get('filters') : [];
            $sortersRequest = $request->get('sorters') ? $request->get('sorters') : [];
            $limiterRequest = $request->get('limiter');

            $query = Transaccion::query();
            $query = SearchFilter::apply(
                $query,
                FilterTransformer::transform($this->filterKeys, $filtersRequest),
                SorterTransformer::transform($sortersRequest)
            );
            
            
            $total = $query->count();

            $limiter = LimiterTransformer::transform($limiterRequest);
            $transacciones = [];
            if($limiter->take > 0){
                $transacciones = $query->skip($limiter->skip)->take($limiter->take)->get();
            }else{
                $transacciones = $query->get();
            }
            

            $response =  new APIResponse(
                200,
                true,
                "Transacciones",
                [
                    'transacciones' => $transacciones->toArray(),
                    'total' => $total
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
