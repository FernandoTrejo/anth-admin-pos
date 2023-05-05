<?php

namespace Src\shared\DTOs;

use DateTime;

class TrasladoProductoDTO
{
    public $codigo_producto;
    public $cantidad;
    public $costo;
    public $linea;
    public $traslado_id;

    public function toArray()
    {
        return [
            'codigo_producto' => $this->codigo_producto ? $this->codigo_producto : '',
            'cantidad' => $this->cantidad ? $this->cantidad : 0,
            'costo' => $this->costo ? $this->costo : 0,
            'linea' => $this->linea ? $this->linea : '',
            'traslado_id' => $this->traslado_id,
        ];
    }
}
