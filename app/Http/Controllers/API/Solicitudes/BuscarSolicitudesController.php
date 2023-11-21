<?php

namespace App\Http\Controllers\API\Solicitudes;

use App\Http\Controllers\Controller;
use App\Models\SolicitudOperacionTienda;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\FilterType;
use Src\shared\Utils\FilterTransformer;
use Src\shared\Utils\LimiterTransformer;
use Src\shared\Utils\SearchFilter;
use Src\shared\Utils\SorterTransformer;

class BuscarSolicitudesController extends Controller
{
    protected $filterKeys = [];
    public function __construct()
    {
        $this->filterKeys = [
            'codigo' => FilterType::$Text,
            'fecha_solicitud' => FilterType::$Date,
            'codigo_usuario_solicitante' => FilterType::$Text,
            'id_usuario_gestion' => FilterType::$Numeric,
            'status' => FilterType::$Text,
            'fecha_resolucion' => FilterType::$Date,
            'tipo_solicitud' => FilterType::$Numeric,
            'codigo_sucursal' => FilterType::$Text,
            'codigo_caja' => FilterType::$Text
        ];
    }

    public function Consultar(Request $request)
    {
        try {
            $filtersRequest = $request->get('filters') ? $request->get('filters') : [];
            $sortersRequest = $request->get('sorters') ? $request->get('sorters') : [];
            $limiterRequest = $request->get('limiter');

            $query = SolicitudOperacionTienda::query();
            $query = SearchFilter::apply(
                $query,
                FilterTransformer::transform($this->filterKeys, $filtersRequest),
                SorterTransformer::transform($sortersRequest)
            );

            $limiter = LimiterTransformer::transform($limiterRequest);
            $solicitudes = [];
            if ($limiter->take > 0) {
                $solicitudes = $query->skip($limiter->skip)->take($limiter->take)->get();
            } else {
                $solicitudes = $query->get();
            }


            $response =  new APIResponse(
                200,
                true,
                "Solicitudes",
                [
                    'solicitudes' => $solicitudes->toArray()
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
