<?php

namespace PHPSigad\Protocolo;

use PHPSigad\PHPSigad;

class Protocolo
{
    static function consultarDocumento($numeroDocumento){
        $sigad = new PHPSigad();

        $igad->uri .= '/protocolo?numeroDocumento='.$numeroDocumento;

        return $sigad->sendRequest();
    }
}