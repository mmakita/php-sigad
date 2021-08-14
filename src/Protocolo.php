<?php

namespace PHPSigad;


class Protocolo
{
    var $user;

    function __construct($user){
        $this->user = $user;
    }

    function consultarDocumento($numeroDocumento){
        $sigad = new PHPSigad($this->user);

        $sigad->uri .= '/protocolo?numeroDocumento='.$numeroDocumento;

        return $sigad->sendRequest();
    }
}