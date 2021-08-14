<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPSigad\PHPSigad;

$sigad = new PHPSigad('mmakita');


print $sigad->token."\n";


use PHPSigad\Protocolo;
$protocolo = new Protocolo('mmakita');
var_dump( $protocolo->consultarDocumento('29827/2013')->body);
