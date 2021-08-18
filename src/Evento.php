<?php

namespace PHPSigad;

class Evento extends PHPSigad
{



    function __construct($user){
        parent::__construct($user);
    }

    function consultarEventos($numeroDocumento){
        $this->uri .= '/evento?numeroDocumento='.$numeroDocumento;

        $this->sendRequest();

        return $this->response->body;
    }
}