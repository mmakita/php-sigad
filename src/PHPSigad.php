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

    function __construct($user){
        $dotenv = Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();

        $this->uri = $_ENV['APIURI'];

        $tk_gen = new TokenGenerator();

        $this->token = $tk_gen->getToken($user)."\n";
    }

    function sendRequest(){
        return Request::get($this->uri)
            ->addHeaders(array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$this->token,
                'Sistema' => $_ENV['SISTEMA']
            ))
            ->send();
    }


}
