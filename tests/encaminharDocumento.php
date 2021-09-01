<?php

require __DIR__ . '/../vendor/autoload.php';

use PHPSigad\PHPSigad;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('./');
$dotenv->load();

use PHPSigad\Tramite;
$tramite = new Tramite($_ENV['USERNAME_SISE']);

$tramites = $tramite->encaminharDocumento('{
	"origem": {
		"codigo": "01.01.46.00.00.00.00"
	},

	"documentos": [{
		"numeroDocumento": "01-P-11902/2021",
		"providencia": "teste automatico"
	}],

	"destinatarios": [{
		"unidade": {
			"codigo": "01.01.46.00.00.00.00"
		},
		"nomeUsuario": "",
		"login": "",
		"complemento": ""
	}],

	"parametros": {
		"urgente": false
	}
}');

print('Retorno: '.print_r($tramites,true)."\n");
