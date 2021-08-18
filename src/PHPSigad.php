<?php

namespace PHPSigad;

use PHPSigad\TokenGenerator\TokenGenerator;
use Dotenv\Dotenv;
use Httpful\Request;

class PHPSigad
{
    /**
     * Token bearer de conexao
     */
    var $token;

    var $uri;
    var $body;
    
    /**
     * @type string
     * Username de quem esta fazendo a requisicao
     */
    var $user;

    /**
     * Resposta da requisicao
     */
    var $response;
    

    function __construct($user){
        $dotenv = Dotenv::createImmutable('./');
        $dotenv->load();

        $this->uri = $_ENV['APIURI'];

        $tk_gen = new TokenGenerator();

        $this->token = $tk_gen->getToken($user);
        $this->user = $user;
    }

    function sendRequest(){
        $this->response =  Request::get($this->uri)
            ->addHeaders(array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.substr($this->token,0),
                'Sistema' => $_ENV['SISTEMA']
            ))
            ->send();
    }


}
