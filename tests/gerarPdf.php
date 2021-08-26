<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPSigad\PHPSigad;
use Dotenv\Dotenv;
use PHPSigad\Digital;

$dotenv = Dotenv::createImmutable('./');
$dotenv->load();

$digital = new Digital($_ENV['USERNAME_SISE']);
$pdf = $digital->gerarPdf('11525/2021','SOLICITAÇÃO DE OBRA (129187)');

var_dump($pdf); exit();

