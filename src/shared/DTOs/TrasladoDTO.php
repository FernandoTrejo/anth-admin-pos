<?php

namespace Src\shared\DTOs;

use DateTime;

class TrasladoDTO
{
    public $uuid;
    public $numero_documento;
    public $codigo_origen;
    public $codigo_destino;
    public $centro_costo_origen;
    public $centro_costo_destino;
    public $status;
    public $fecha_envio;
    public $fecha_recepcion_sucursal;
    public $fecha_declinacion_sucursal;

    public $productos;

    public function toArray()
    {
        return [
            'uuid' => $this->uuid,
            'numero_documento' => $this->numero_documento ? $this->numero_documento : '',
            'codigo_origen' => $this->codigo_origen ? $this->codigo_origen : '',
            'codigo_destino' => $this->codigo_destino ? $this->codigo_destino : '',
            'centro_costo_origen' => $this->centro_costo_origen ? $this->centro_costo_origen : '',
            'centro_costo_destino' => $this->centro_costo_destino ? $this->centro_costo_destino : '',
            'status' => $this->status ? $this->status : '',
            'fecha_envio' => $this->fecha_envio ? $this->fecha_envio : new DateTime(),
            'fecha_recepcion_sucursal' => $this->fecha_recepcion_sucursal ? $this->fecha_recepcion_sucursal : null,
            'fecha_declinacion_sucursal' => $this->fecha_declinacion_sucursal ? $this->fecha_declinacion_sucursal : null,

            'productos' => $this->productos ? $this->productos : []
        ];
    }
}
