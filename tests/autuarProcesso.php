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

$processo_cad = $protocolo->autuarProcesso('{
    "codigoUnidadeProtocolo": "01.01.46.00.00.00.00",
    "codigoUnidadeProcedencia": "01.01.46.00.00.00.00",
    "tipoMeio":"DIGITAL" ,
    "interessados": [
      {
        "principal": true ,
        "tipoInteressado": "OUTROS" ,
        "documentoIdentificacao": "12345",
        "nome": "DEPI"
      }
    ],
    "classificacaoAssunto": {
      "codigoTipoDocumental": "01.02.01.02",
      "assunto": "PROJETO DE PLANEJAMENTO E EXECUÇÃO DA INTEGRAÇÃO DOS SISTEMAS DE GERENCIAMENTO DE DOCUMENTOS DA DEPI E SIARQ",
      "acesso": "PUBLICO"
    },
    "exclusivoSistExterno": false
}');

print('Documento cadastrado: ' . $processo_cad->numeroDocumento."\n");

$processo = $protocolo->consultarDocumento($processo_cad->numeroDocumento)[0];

print('Documento Lido: ' . $processo->categoria . ' '. $processo->tipoMeio .' '.$processo->numeroDocumento.': '.$processo->classificacaoAssunto->assunto."\n");
