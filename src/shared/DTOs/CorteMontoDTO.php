<?php

namespace Src\shared\DTOs;

class CorteMontoDTO
{

    public $codigo_tipo_pago;
    public $tipo_corte;
    public $tipo_pago;
    public $monto;
    public $corte_id;

    public function toArray()
    {
        return [
            'codigo_tipo_pago' => $this->codigo_tipo_pago,
            'tipo_corte' => $this->tipo_corte,
            'tipo_pago' => $this->tipo_pago,
            'monto' => $this->monto,
            'corte_id' => $this->corte_id
        ];
    }
}
