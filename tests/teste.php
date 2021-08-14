<?php

require __DIR__ . '/../vendor/autoload.php';


//$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/..');
//$dotenv->load();

//require 'src/TokenGenerator/TokenGenerator.php';
use PHPSigad\PHPSigad;

$sigad = new PHPSigad('mmakita');


print $sigad->token."\n";


use PHPSigad\Protocolo\Protocolo;
$protocolo = new Protocolo('mmakita');
var_dump( $protocolo->consultarDocumento('29827/2013'));
