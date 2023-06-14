<?php

namespace Src\shared\DTOs;

use DateTime;

class ClienteDTO
{
    public $codigo;
    public $nombre_cliente;
    public $nrc;
    public $nit;
    public $dui;
    public $direccion;
    public $actividad_economica;
    public $tipo_cliente;

    public function toArray()
    {
        return [
            'codigo' => $this->codigo,
            'nombre_cliente' => $this->nombre_cliente,
            'nrc' => $this->nrc ? $this->nrc : '',
            'nit' => $this->nit ? $this->nit : '',
            'dui' => $this->dui ? $this->dui : '',
            'direccion' => $this->direccion ? $this->direccion : '',
            'actividad_economica' => $this->actividad_economica ? $this->actividad_economica : '',
            'tipo_cliente' => $this->tipo_cliente ? $this->tipo_cliente : '',
        ];
    }
}
