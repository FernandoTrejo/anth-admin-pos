<?php

namespace Src\shared;

class TipoDocumentos
{
    public static $TicketVenta = 'ticket_venta';
    public static $FacturaConsumidorFinal = 'factura_consumidor_final';
    public static $CreditoFiscal = 'credito_fiscal';
    public static $TicketDevolucion = 'ticket_devolucion';
    public static $TicketOtrosIngresos = 'ticket_otros_egresos';
    public static $TicketOtrosEgresos = 'ticket_otros_ingresos';
    public static $TicketAnticipos = 'ticket_anticipos';
    public static $Traslados = 'traslados_a_sucursales';

    public function TraducirTipoDocumento($codigo)
    {
        $texto = '';
        switch ($codigo) {
            case self::$CreditoFiscal:
                $texto = 'Credito Fiscal';
                break;
            case self::$FacturaConsumidorFinal:
                $texto = 'Factura';
                break;
            case self::$TicketVenta:
                $texto = 'Ticket';
                break;
            case self::$TicketDevolucion:
                $texto = 'Ticket Devolucion';
                break;
            case self::$TicketOtrosEgresos:
                $texto = 'Ticket Otros Egresos';
                break;
            case self::$TicketOtrosIngresos:
                $texto = 'Ticket Otros Ingresos';
                break;
            case self::$TicketAnticipos:
                $texto = 'Ticket Anticipos';
                break;
            case self::$Traslados:
                $texto = 'Traslados A Sucursales';
                break;
            default:
                $texto = '';
        }
        return $texto;
    }
}
