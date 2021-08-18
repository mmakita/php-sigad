<?php

namespace PHPSigad;

class Protocolo extends PHPSigad
{

    function __construct($user){
        parent::__construct($user);
    }

    function consultarDocumento($numeroDocumento){
        $this->setRequestMethod('get');
        $this->setUri('/protocolo?numeroDocumento='.$numeroDocumento);
        $this->sendRequest();

        return $this->response->body;
    }

    function autuarProcesso($dadosProcesso){
        $this->setRequestMethod('post');
        $this->setUri('/protocolo/processo');

        $this->sendRequest($dadosProcesso);

        return $this->response->body;

    }
}