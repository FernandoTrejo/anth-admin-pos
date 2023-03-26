<?php

namespace App\Http\Controllers;

use App\Events\TrasladoEnviado;
use App\Models\Traslado;
use App\Models\TrasladoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrasladoController extends Controller
{
    public function CrearNuevo(Request $request){
        try {
            DB::transaction(function() use ($request){
                $datos = $request->validate([
                    'codigo_origen' => ['required'],
                    'codigo_destino' => ['required'],
                    'productos' => ['required', 'array']
                ]);
        
                $traslado = Traslado::create([
                    'codigo_origen' => $datos['codigo_origen'],
                    'codigo_destino' => $datos['codigo_destino']
                ]);
        
                $productos = $datos['productos'];
    
                foreach($productos as $producto){
                    $producto['traslado_id'] = $traslado->id;
                    TrasladoProducto::create($producto);
                }
    
                echo "Traslado enviado";
                TrasladoEnviado::dispatch($traslado, $productos);
            });
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
