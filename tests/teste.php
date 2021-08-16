<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPSigad\PHPSigad;

$sigad = new PHPSigad('mmakita');


print 'token gerado :'.$sigad->token."\n";


use PHPSigad\Protocolo;
$protocolo = new Protocolo('mmakita');
$processo = $protocolo->consultarDocumento('29827/2013');


var_dump($processo[0]->classificacaoAssunto->assunto);