<?php

namespace Src\shared\DTOs;

use DateTime;

class CorteDTO
{
    public $codigo;
    public $tipo_corte;
    public $fecha_hora_corte;
    public $fecha_fin_corte;
    public $codigo_usuario;
    public $codigo_sucursal;
    public $codigo_caja;

    public $montos;

    public function toArray()
    {
        return [
            'codigo' => $this->codigo,
            'tipo_corte' => $this->tipo_corte, // mensual, diario, parcial
            'fecha_hora_corte' => $this->fecha_hora_corte,
            'fecha_fin_corte' => ($this->fecha_fin_corte) ? $this->fecha_fin_corte : new DateTime(),
            'codigo_usuario' => $this->codigo_usuario,
            'codigo_sucursal' => $this->codigo_sucursal,
            'codigo_caja' => $this->codigo_caja,
            'montos' => $this->montos
        ];
    }
}
