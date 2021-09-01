<?php

namespace PHPSigad;

class Tramite extends PHPSigad
{

    function __construct($user){
        parent::__construct($user);
    }

    function consultarTramites($numeroDocumento){
        $this->setRequestMethod('get');
        $this->setUri('/tramite?numeroDocumento='.$numeroDocumento);

        $this->sendRequest();

        return $this->response->body;
    }

    function encaminharDocumento($dadosTramitacao){
        $this->setRequestMethod('post');
        $this->setUri('/tramite');

        $this->sendRequest($dadosTramitacao);

        return $this->response->body;
    }
}