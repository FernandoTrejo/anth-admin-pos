<?php

namespace Src\shared\DTOs;

class TransaccionProductoDTO
{
    public $codigo_producto;
    public $nombre_producto;
    public $precio;
    public $cantidad;
    public $subtotal;
    public $porcentaje_descuento;
    public $valor_descuento;
    public $precio_sin_descuento;
    public $codigo_orden;
    public $codigo_corte_x;


    public function toArray()
    {
        return [
            'codigo_producto' => $this->codigo_producto,
            'nombre_producto' => $this->nombre_producto,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'codigo_orden' => $this->codigo_orden,
            'subtotal' => $this->subtotal,
            'porcentaje_descuento' => $this->porcentaje_descuento,
            'valor_descuento' => $this->valor_descuento,
            'precio_sin_descuento' => $this->precio_sin_descuento,
            'codigo_corte_x' => $this->codigo_corte_x
        ];
    }
}
