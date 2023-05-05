<?php

namespace Src\shared\DTOs;

class KardexDTO
{


    public $codigo;
    public $fecha_hora;
    public $codigo_producto;
    public $cantidad;
    public $costo;
    public $precio;
    public $precio_sin_descuento;
    public $tipo_movimiento;
    public $numero_documento;
    public $status;
    public $codigo_orden;
    public $centro_costo;
    public $clave_sucursal;
    public $clave_caja;
    public $proveedor_cliente;
    public $tipo_transaccion;


    public function toArray()
    {
        return [
            'codigo' => $this->codigo,
            'fecha_hora' => $this->fecha_hora,
            'codigo_producto' => $this->codigo_producto,
            'cantidad' => $this->cantidad,
            'costo' => $this->costo,
            'precio' => $this->precio,
            'precio_sin_descuento' => $this->precio_sin_descuento,
            'tipo_movimiento' => $this->tipo_movimiento,
            'numero_documento' => $this->numero_documento,
            'status' => $this->status,
            'tipo_transaccion' => $this->tipo_transaccion,
            'proveedor_cliente' => ($this->proveedor_cliente) ? $this->proveedor_cliente : '',
            'codigo_orden' => ($this->codigo_orden) ? $this->codigo_orden : '',
            'centro_costo' => $this->centro_costo,
            'clave_sucursal' => $this->clave_sucursal,
            'clave_caja' => $this->clave_caja,
        ];
    }
}
