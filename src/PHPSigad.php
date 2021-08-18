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

    var $requestMethod;
    
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

    function setUri($uri){
        $this->uri = $_ENV['APIURI'].$uri;
    }

    function setRequestMethod($method){
        $this->requestMethod = $method;
    }

    function sendRequest($requestBody = ''){
        $this->response =  Request::{$this->requestMethod}($this->uri)
            ->addHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.substr($this->token,0),
                'Sistema' => $_ENV['SISTEMA']
            ])
            ->sendsJson()
            ->body($requestBody)
            ->send();
    }


}
