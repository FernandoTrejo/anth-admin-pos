<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Caja;
use App\Models\FormaPago;
use App\Models\Numerador;
use App\Models\Sucursal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Src\shared\TipoDocumentos;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //creacion de sucursales
        $planta = Sucursal::create([
            'codigo' => '69ed8ad3-1138-40a9-ba36-89d9c2882359',
            'nombre' => 'PLANTA',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo'
        ]);
        $encuentro = Sucursal::create([
            'codigo' => '50c1bb68-2e10-49f3-80a6-82fc548a6d17',
            'nombre' => 'SUC. EL ENCUENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo'
        ]);
        $metrocentro = Sucursal::create([
            'codigo' => '5eef59fe-d911-4b9d-8984-b0584ea09a10',
            'nombre' => 'SUC. METROCENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo'
        ]);


        $cajaEncuentro = Caja::create([
            'codigo' => '56ccbec0-6bf3-4507-9aad-3a80ed6e651e',
            'titulo' => 'Caja #1',
            'sucursal_id' => $encuentro->id
        ]);
        $cajaMetro = Caja::create([
            'codigo' => '275fd84d-9a5b-4e01-b1fe-09111295163c',
            'titulo' => 'Caja #2',
            'sucursal_id' => $metrocentro->id
        ]);
        $cajas = [$cajaEncuentro, $cajaMetro];

        //creacion de bodegas
        Bodega::create([
            'nombre' => 'Bodega General',
            'codigo_tienda' => '0000000000',
            'sucursal_id' => $planta->id
        ]);
        Bodega::create([
            'nombre' => 'El Encuentro',
            'codigo_tienda' => '1111111111',
            'sucursal_id' => $encuentro->id
        ]);
        Bodega::create([
            'nombre' => 'Metrocentro',
            'codigo_tienda' => '2222222222',
            'sucursal_id' => $metrocentro->id
        ]);


        //creacion de formas de pago basicas
        $efectivo = FormaPago::create([
            'codigo' => 'efectivo',
            'titulo' => 'Efectivo',
            'categoria' => 'efectivo',
            'status' => 'activo'
        ]);
        $tarjeta = FormaPago::create([
            'codigo' => 'tarjeta',
            'titulo' => 'Tarjeta',
            'categoria' => 'otro',
            'status' => 'activo'
        ]);
        $anticipo = FormaPago::create([
            'codigo' => 'F001',
            'titulo' => 'Anticipo Liquidado',
            'categoria' => 'otro',
            'status' => 'activo'
        ]);
        $goeat = FormaPago::create([
            'codigo' => 'F002',
            'titulo' => 'Delivery',
            'categoria' => 'otro',
            'status' => 'activo'
        ]);

        //enlazar formas de pago
        $metrocentro->formasPago()->sync([
            $efectivo->id, $tarjeta->id, $anticipo->id
        ]);
        $encuentro->formasPago()->sync([
            $efectivo->id, $tarjeta->id, $anticipo->id, $goeat->id
        ]);


        //creacion de numeradores
        foreach($cajas as $caja){
            $num1 = Numerador::create([
                'tipo_documento' => TipoDocumentos::$FacturaConsumidorFinal,
                'nombre' => 'Factura Consumidor Final',
                'prefijo' => 'F0-',
                'numeracion' => '0000',
                'inicio' => 1,
                'fin' => 100,
                'actual' => 0,
                'caja_id' => $caja->id
            ]);
            $num2 = Numerador::create([
                'tipo_documento' => TipoDocumentos::$CreditoFiscal,
                'nombre' => 'Credito Fiscal',
                'prefijo' => '',
                'numeracion' => '0000',
                'inicio' => 1,
                'fin' => 100,
                'actual' => 0,
                'caja_id' => $caja->id
            ]);
            $num3 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketVenta,
                'nombre'=> 'Ticket de Venta',
                'prefijo'=> '',
                'numeracion'=> '0000',
                'inicio'=> 1,
                'fin'=> 100,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num4 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketDevolucion,
                'nombre'=> 'Ticket Devolucion',
                'prefijo'=> 'D-',
                'numeracion'=> '0000',
                'inicio'=> 1,
                'fin'=> 100,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num5 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketOtrosEgresos,
                'nombre'=> 'Ticket Otros Egresos',
                'prefijo'=> 'E-',
                'numeracion'=> '0000',
                'inicio'=> 1,
                'fin'=> 100,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num6 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketOtrosIngresos,
                'nombre'=> 'Ticket Otros Ingresos',
                'prefijo'=> 'I-',
                'numeracion'=> '0000',
                'inicio'=> 1,
                'fin'=> 100,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num7 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketAnticipos,
                'nombre'=> 'Ticket Anticipos',
                'prefijo'=> 'A-',
                'numeracion'=> '0000',
                'inicio'=> 1,
                'fin'=> 100,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
        }
        
    }
}
