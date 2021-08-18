<?php

namespace PHPSigad;

class Protocolo extends PHPSigad
{

    function __construct($user){
        parent::__construct($user);
    }

    function consultarDocumento($numeroDocumento){

        $this->uri .= '/protocolo?numeroDocumento='.$numeroDocumento;

        $this->sendRequest();

        return $this->response->body;
    }
}