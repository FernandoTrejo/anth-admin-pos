<?php

namespace Src\shared\DTOs;


class ProductoContenidoDTO
{

    public $codigo_producto_contenido;
    public $cantidad;
    public $producto_id;

    public function toArray()
    {
        return [
            'codigo_producto_contenido' => $this->codigo_producto_contenido,
            'cantidad' => $this->cantidad,
            'producto_id' => $this->producto_id
        ];
    }
}
