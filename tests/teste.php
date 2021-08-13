<?php

require __DIR__ . '/../vendor/autoload.php';


$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

//require 'src/TokenGenerator/TokenGenerator.php';
use PHPSigad\TokenGenerator;

$tk_gen = new TokenGenerator();


print $tk_gen->getToken('mmakita')."\n";
