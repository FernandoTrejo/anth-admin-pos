<?php

namespace App\Http\Controllers;

use App\Events\TrasladoEnviado;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\Traslado;
use App\Models\TrasladoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrasladoController extends Controller
{
    public function CrearNuevo(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $datos = $request->validate([
                    'codigo_origen' => ['required'],
                    'codigo_destino' => ['required'],
                    'empresa_id' => ['required'],
                    'numero_documento' => ['required'],
                    'codigos_productos' => ['required', 'array']
                ]);

                $tiendaOrigen = Sucursal::where('codigo', $datos['codigo_origen'])->first();
                $tiendaDestino = Sucursal::where('codigo', $datos['codigo_destino'])->first();

                $traslado = Traslado::create([
                    'codigo_origen' => $datos['codigo_origen'],
                    'codigo_destino' => $datos['codigo_destino'],
                    'numero_documento' => $datos['numero_documento'],
                    'titulo_origen' => $tiendaOrigen->nombre,
                    'titulo_destino' => $tiendaDestino->nombre,
                    'empresa_id' => $datos['empresa_id']
                ]);

                $codigosProductos = $datos['codigos_productos'];
                $productos = [];
                foreach ($codigosProductos as $codigo) {
                    $producto = Producto::where('codigo', $codigo['codigo'])->first();
                    $productoTraslado = [
                        'codigo_producto' => $producto->codigo,
                        'nombre_producto' => $producto->nombre,
                        'imagen_url' => $producto->imagen_url,
                        'cantidad' => $codigo['cantidad'],
                        'costo' => $producto->costo,
                        'precio' => $producto->precio,
                        'traslado_id' => $traslado->id
                    ];
                    TrasladoProducto::create($productoTraslado);
                    $productos[] = $productoTraslado;
                }

                echo "Traslado enviado";
                TrasladoEnviado::dispatch($traslado, $productos);
            });
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
