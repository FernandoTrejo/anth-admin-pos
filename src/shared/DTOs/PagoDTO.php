<?php

namespace Src\shared\DTOs;

class PagoDTO
{

    public $tipo_pago;
    public $emisor;
    public $recibido;
    public $vuelto;
    public $codigo_orden;
    public $numero_autorizacion;
    public $numero_telefono;
    public $ultimos_digitos_tarjeta;


    public function toArray()
    {
        return [
            'tipo_pago' => $this->tipo_pago,
            'emisor' => $this->emisor ? $this->emisor : '',
            'recibido' => $this->recibido ? $this->recibido : 0,
            'vuelto' => ($this->vuelto) ? $this->vuelto : 0,
            'codigo_orden' => $this->codigo_orden,
            'numero_autorizacion' => $this->numero_autorizacion ? $this->numero_autorizacion : '',
            'numero_telefono' => $this->numero_telefono ? $this->numero_telefono : '',
            'ultimos_digitos_tarjeta' => $this->ultimos_digitos_tarjeta ? $this->ultimos_digitos_tarjeta : ''
        ];
    }
}
