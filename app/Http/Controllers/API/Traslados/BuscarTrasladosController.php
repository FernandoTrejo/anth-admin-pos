<?php

namespace App\Http\Controllers\API\Traslados;

use App\Http\Controllers\Controller;
use App\Models\Traslado;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\FilterType;
use Src\shared\Utils\FilterTransformer;
use Src\shared\Utils\LimiterTransformer;
use Src\shared\Utils\SearchFilter;
use Src\shared\Utils\SorterTransformer;

class BuscarTrasladosController extends Controller
{
    protected $filterKeys = [];
    public function __construct()
    {
        $this->filterKeys = [
            'uuid' => FilterType::$Text,
            'fecha_envio' => FilterType::$Date,
            'numero_documento' => FilterType::$Text,
            'codigo_origen' => FilterType::$Text,
            'codigo_destino' => FilterType::$Text,
            'referencia' => FilterType::$Text,
            'status' => FilterType::$Text
        ];
    }

    public function Consultar(Request $request)
    {
        try {
            $filtersRequest = $request->get('filters') ? $request->get('filters') : [];
            $sortersRequest = $request->get('sorters') ? $request->get('sorters') : [];
            $limiterRequest = $request->get('limiter');

            $query = Traslado::query();
            $query = SearchFilter::apply(
                $query,
                FilterTransformer::transform($this->filterKeys, $filtersRequest),
                SorterTransformer::transform($sortersRequest)
            );
            
            $total = $query->count();

            $limiter = LimiterTransformer::transform($limiterRequest);
            $traslados = [];
            if($limiter->take > 0){
                $traslados = $query->skip($limiter->skip)->take($limiter->take)->get();
            }else{
                $traslados = $query->get();
            }
            

            $response =  new APIResponse(
                200,
                true,
                "Traslados",
                [
                    'traslados' => $traslados->toArray(),
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
