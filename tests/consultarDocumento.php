<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPSigad\PHPSigad;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('./');
$dotenv->load();

$sigad = new PHPSigad($_ENV['USERNAME_SISE']);


print 'token gerado:'.$sigad->token."\n";


use PHPSigad\Protocolo;
$protocolo = new Protocolo($_ENV['USERNAME_SISE']);
$processo = $protocolo->consultarDocumento('23572/2014');


var_dump($processo[0]->classificacaoAssunto->assunto);


use PHPSigad\Evento;
$evento = new Evento($_ENV['USERNAME_SISE']);
$eventos_doc = $evento->consultarEventos('23572/2014');

var_dump($eventos_doc);

use PHPSigad\Tramite;
$tramite = new Tramite($_ENV['USERNAME_SISE']);
$tramites_doc = $tramite->consultarTramites('23572/2014');

var_dump($tramites_doc);