<?php

namespace PHPSigad;

class Protocolo
{
    /**
     * @type string
     * Username de quem esta fazendo a requisicao
     */
    var $user;

    /**
     * Variavel que guarda a conexao (para debug, respostas das reqs, etc)
     */
    var $sigad;

    function __construct($user){
        $this->user = $user;
    }

    function consultarDocumento($numeroDocumento){
        $this->sigad = new PHPSigad($this->user);

        $this->sigad->uri .= '/protocolo?numeroDocumento='.$numeroDocumento;

        $this->sigad->sendRequest();

        return $this->sigad->response->body;
    }
}