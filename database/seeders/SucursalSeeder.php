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
            'status' => 'activo',
            'clave_centro_costo' => '0000'
        ]);
        $encuentro = Sucursal::create([
            'codigo' => '50c1bb68-2e10-49f3-80a6-82fc548a6d17',
            'nombre' => 'SUC. EL ENCUENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '16'
        ]);
        $metrocentro = Sucursal::create([
            'codigo' => '5eef59fe-d911-4b9d-8984-b0584ea09a10',
            'nombre' => 'SUC. METROCENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '7'
        ]);
        $terminal1 = Sucursal::create([
            'codigo' => 'c20cb0c9-3e23-4fd8-abf3-49de5d0f6d5d',
            'nombre' => 'SUC. TERMINAL',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '2'
        ]);
        $carasucia1 = Sucursal::create([
            'codigo' => '74335ca8-02e5-4b54-9221-0d3231653d90',
            'nombre' => 'SUC. CARA SUCIA 1',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '5'
        ]);
        $centro = Sucursal::create([
            'codigo' => 'a5e08867-31c9-43fb-a077-54138c554085',
            'nombre' => 'SUC. CENTRO',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '6'
        ]);
        $linea = Sucursal::create([
            'codigo' => '26c8782e-1756-4732-8521-4c86b9d0c7d2',
            'nombre' => 'SUC. LINEA FERREA',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '12'
        ]);
        $acajutla1 = Sucursal::create([
            'codigo' => 'bb599492-a093-4fd9-80b5-618fe8f1345f',
            'nombre' => 'SUC. ACAJUTLA 1',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '13'
        ]);
        $carasucia2 = Sucursal::create([
            'codigo' => '4653e24c-823d-44cc-90a2-abd56f37dade',
            'nombre' => 'SUC. CARA SUCIA 2',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '64'
        ]);
        $casamatriz = Sucursal::create([
            'codigo' => 'fb807e8a-afa3-43b3-80c8-b434399f5f91',
            'nombre' => 'SUC. CASA MATRIZ',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '1'
        ]);
        $acajutla2 = Sucursal::create([
            'codigo' => '4f3166ac-73a3-453f-a017-1e40d4ec26a1',
            'nombre' => 'SUC. ACAJUTLA 2',
            'direccion' => '',
            'telefono' => '',
            'correo' => '',
            'status' => 'activo',
            'clave_centro_costo' => '148'
        ]);

        $cajaEncuentro = Caja::create([
            'codigo' => '56ccbec0-6bf3-4507-9aad-3a80ed6e651e',
            'titulo' => 'Caja #1 Encuentro',
            'tipo' => 'caja_principal',
            'sucursal_id' => $encuentro->id
        ]);
        $cajaEncuentro2 = Caja::create([
            'codigo' => '10541144-c8bb-4e83-ad21-430ba52f08ca',
            'titulo' => 'Caja #2 Encuentro',
            'tipo' => 'caja_secundaria',
            'sucursal_id' => $encuentro->id
        ]);
        $cajaCentro1 = Caja::create([
            'codigo' => '4ee94184-76f7-4a88-b4a7-21e6717fd9f6',
            'titulo' => 'Caja #1 Centro',
            'tipo' => 'caja_principal',
            'sucursal_id' => $centro->id
        ]);
        $cajaCentro2 = Caja::create([
            'codigo' => 'e9e443ad-7327-403f-8e10-b493c787b44d',
            'titulo' => 'Caja #2 Centro',
            'tipo' => 'caja_secundaria',
            'sucursal_id' => $centro->id
        ]);
        $cajaMetro = Caja::create([
            'codigo' => '275fd84d-9a5b-4e01-b1fe-09111295163c',
            'titulo' => 'Caja #1 Metrocentro',
            'tipo' => 'caja_principal',
            'sucursal_id' => $metrocentro->id
        ]);
        $cajaMetroSecundaria = Caja::create([
            'codigo' => 'e1a00142-3b7d-420e-993f-28c1c88e627a',
            'titulo' => 'Caja #2 Metrocentro',
            'tipo' => 'caja_secundaria',
            'sucursal_id' => $metrocentro->id
        ]);
        $cajaMetroMovil = Caja::create([
            'codigo' => '82338748-3a2c-4b9a-a4f3-a75079260465c',
            'titulo' => 'Caja Movil #1 Metrocentro',
            'tipo' => 'caja_movil',
            'sucursal_id' => $metrocentro->id
        ]);
        $cajaTerminal = Caja::create([
            'codigo' => 'd608027f-f694-41a0-8416-2b0d0e2da522',
            'titulo' => 'Caja #1 Terminal',
            'tipo' => 'caja_principal',
            'sucursal_id' => $terminal1->id
        ]);
        $cajaCarasucia1 = Caja::create([
            'codigo' => '49a8946e-463d-43eb-ae80-7431dc7227ea',
            'titulo' => 'Caja #1 Cara Sucia 1',
            'tipo' => 'caja_principal',
            'sucursal_id' => $carasucia1->id
        ]);
        $cajaCarasucia2 = Caja::create([
            'codigo' => '2b6fbe47-52e6-4fa6-ac86-686c60204a9b',
            'titulo' => 'Caja #1 Cara Sucia 2',
            'tipo' => 'caja_principal',
            'sucursal_id' => $carasucia2->id
        ]);
        $cajaLinea = Caja::create([
            'codigo' => '1efc16b6-7f3c-4e40-8994-d779f481b2d7',
            'titulo' => 'Caja #1 Linea Ferrea',
            'tipo' => 'caja_principal',
            'sucursal_id' => $linea->id
        ]);
        $cajaAcajutla1 = Caja::create([
            'codigo' => '020694c4-0c99-4541-9418-83bd9194baa1',
            'titulo' => 'Caja #1 Acajutla 1',
            'tipo' => 'caja_principal',
            'sucursal_id' => $acajutla1->id
        ]);
        $cajaAcajutla2 = Caja::create([
            'codigo' => '7af4fed5-55cf-4276-ae4e-040ff4641327',
            'titulo' => 'Caja #1 Acajutla 2',
            'tipo' => 'caja_principal',
            'sucursal_id' => $acajutla2->id
        ]);
        $cajaMatriz = Caja::create([
            'codigo' => '092e52ea-f95c-4d9e-a442-31790efb9046',
            'titulo' => 'Caja #1 Casa Matriz',
            'tipo' => 'caja_principal',
            'sucursal_id' => $casamatriz->id
        ]);
        $cajas = [
            $cajaEncuentro, 
            $cajaMetro, 
            $cajaMetroSecundaria, 
            $cajaMetroMovil,
            $cajaMatriz,
            $cajaAcajutla2,
            $cajaAcajutla1,
            $cajaLinea,
            $cajaCarasucia2,
            $cajaCarasucia1,
            $cajaTerminal,
            $cajaEncuentro2,
            $cajaCentro1,
            $cajaCentro2
        ];

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

        $sucursales = [
            $encuentro,
            $metrocentro,
            $terminal1,
            $carasucia1,
            $centro,
            $linea,
            $acajutla1,
            $carasucia2,
            $casamatriz,
            $acajutla2,
        ];

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
            'codigo' => 'anticipo',
            'titulo' => 'Anticipo Liquidado',
            'categoria' => 'otro',
            'status' => 'activo'
        ]);
        $goeat = FormaPago::create([
            'codigo' => 'delivery',
            'titulo' => 'Delivery',
            'categoria' => 'otro',
            'status' => 'activo'
        ]);
        $valeDescuento = FormaPago::create([
            'codigo' => 'vale_descuento',
            'titulo' => 'Vale Descuento',
            'categoria' => 'otro',
            'status' => 'activo'
        ]);

        foreach($sucursales as $sucursal){
            $sucursal->formasPago()->sync([
                $efectivo->id, $tarjeta->id, $anticipo->id, $goeat->id, $valeDescuento->id
            ]);
        }


        //creacion de numeradores
        foreach($cajas as $caja){
            $num1 = Numerador::create([
                'tipo_documento' => TipoDocumentos::$FacturaConsumidorFinal,
                'nombre' => 'Factura Consumidor Final',
                'prefijo' => 'F0-',
                'numeracion' => '0000000000000',
                'inicio' => 1,
                'fin' => 1000000000,
                'actual' => 0,
                'caja_id' => $caja->id
            ]);
            $num2 = Numerador::create([
                'tipo_documento' => TipoDocumentos::$CreditoFiscal,
                'nombre' => 'Credito Fiscal',
                'prefijo' => '',
                'numeracion' => '0000000000000',
                'inicio' => 1,
                'fin' => 1000000000,
                'actual' => 0,
                'caja_id' => $caja->id
            ]);
            $num3 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketVenta,
                'nombre'=> 'Ticket de Venta',
                'prefijo'=> '',
                'numeracion'=> '0000000000000',
                'inicio'=> 1,
                'fin'=> 1000000000,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num4 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketDevolucion,
                'nombre'=> 'Ticket Devolucion',
                'prefijo'=> 'D-',
                'numeracion'=> '0000000000000',
                'inicio'=> 1,
                'fin'=> 1000000000,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num5 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketOtrosEgresos,
                'nombre'=> 'Ticket Otros Egresos',
                'prefijo'=> 'E-',
                'numeracion'=> '0000000000000',
                'inicio'=> 1,
                'fin'=> 1000000000,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num6 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketOtrosIngresos,
                'nombre'=> 'Ticket Otros Ingresos',
                'prefijo'=> 'I-',
                'numeracion'=> '0000000000000',
                'inicio'=> 1,
                'fin'=> 1000000000,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num7 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$TicketAnticipos,
                'nombre'=> 'Ticket Anticipos',
                'prefijo'=> 'A-',
                'numeracion'=> '0000000000000',
                'inicio'=> 1,
                'fin'=> 1000000000,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
            $num8 = Numerador::create([
                'tipo_documento'=> TipoDocumentos::$Traslados,
                'nombre'=> 'Traslados A Sucursales',
                'prefijo'=> 'TS',
                'numeracion'=> '0000000000000',
                'inicio'=> 1,
                'fin'=> 1000000000,
                'actual'=> 0,
                'caja_id' => $caja->id
            ]);
        }
        
    }
}
