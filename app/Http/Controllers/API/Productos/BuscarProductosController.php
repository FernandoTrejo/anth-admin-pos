<?php

namespace App\Http\Controllers\API\Productos;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Src\shared\APIResponse;
use Src\shared\Proveedores;

class BuscarProductosController extends Controller
{
    public function Consultar(Request $request)
    {
        try {

            $datos = $request->all();
            
            $skip = $datos['skip'];
            $take = $datos['take'];
            $search = $datos['search'];
            $field = $datos['field'];

            $inventario = [];
            $count = Producto::where($field, 'like', "%$search%")->whereIn('proveedor', Proveedores::getAll())->count();
            if ($take > 0) {
                $inventario = Producto::where($field, 'like', "%$search%")->whereIn('proveedor', Proveedores::getAll())->skip($skip)->take($take)->get()->toArray();
            } else {
                $inventario = Producto::where($field, 'like', "%$search%")->whereIn('proveedor', Proveedores::getAll())->get()->toArray();
            }

            $response =  new APIResponse(
                200,
                true,
                "Listado de productos",
                [
                    'productos' => $inventario,
                    'total' => $count
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
