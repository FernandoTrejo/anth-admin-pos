<?php

namespace Src\shared\DTOs;

class TransaccionDTO
{
    public $codigo;
    public $numero_transaccion;
    public $fecha;
    public $nombre_cliente;
    public $codigo_cliente;
    public $total;
    public $status;
    public $corte_mensual;
    public $corte_diario;
    public $corte_parcial;
    public $tipo_documento_clave;
    public $forma_pago;
    public $descripcion;
    public $referencia;
    public $codigo_vendedor;
    public $codigo_caja;
    public $codigo_sucursal;
    public $codigo_usuario;
    public $tipo_transaccion;
    public $descuento_total;
    public $caja_id;
    public $iva;

    public $pagos;
    public $productos_orden;


    public function toArray()
    {
        return [
            'codigo' => $this->codigo,
            'numero_transaccion' => $this->numero_transaccion,
            'fecha' => $this->fecha,
            'nombre_cliente' => ($this->nombre_cliente) ? $this->nombre_cliente : '',
            'codigo_cliente' => ($this->codigo_cliente) ? $this->codigo_cliente : '',
            'total' => $this->total,
            'status' => $this->status,
            'corte_mensual' => $this->corte_mensual,
            'corte_diario' => $this->corte_diario,
            'corte_parcial' => $this->corte_parcial,
            'tipo_documento_clave' => $this->tipo_documento_clave,
            'forma_pago' => $this->forma_pago ? $this->forma_pago : '',
            'descripcion' => $this->descripcion ? $this->descripcion : '',
            'referencia' => $this->referencia ? $this->referencia : '',
            'codigo_vendedor' => $this->codigo_vendedor ? $this->codigo_vendedor : '',
            'codigo_caja' => $this->codigo_caja,
            'codigo_sucursal' => $this->codigo_sucursal,
            'codigo_usuario' => $this->codigo_usuario,
            'tipo_transaccion' => $this->tipo_transaccion,
            'descuento_total' => $this->descuento_total ? $this->descuento_total : 0,
            'caja_id' => $this->caja_id,
            'iva' => $this->iva,
            'pagos' => $this->pagos ? $this->pagos : [],
            'productos_orden' => $this->productos_orden ? $this->productos_orden : []
        ];
    }
}
