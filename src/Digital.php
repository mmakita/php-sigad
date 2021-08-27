<?php

namespace PHPSigad;

class Digital extends PHPSigad
{

    function __construct($user){
        parent::__construct($user);
    }

    function gerarPdf($numeroDocumento, $nomeDocumentoDigital=''){
        $this->setRequestMethod('get');
        $this->setUri('/digital/pdf?numeroDocumento='.$numeroDocumento.'&nomeDocumentoDigital='.urlencode($nomeDocumentoDigital));

        $this->sendRequest();

        return $this->response->body;
    }
}