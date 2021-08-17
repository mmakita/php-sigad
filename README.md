# php-sigad
Pacote para acessar documentos do sigad


## Instalação

### Via composer

`composer require sigad/php-sigad`

Criar um arquivo .env conforme o .env.example trocando o nome do arquivo PEM e SISTEMA conforme instruções
Criar um arquivo .pem com o mesmo nome da variável PEM_FILE 


## Exemplo de código

```<?php

require __DIR__ . '/../vendor/autoload.php';

print 'token gerado :'.$sigad->token."\n";


use PHPSigad\Protocolo;
$protocolo = new Protocolo('mmakita');
$processo = $protocolo->consultarDocumento('29827/2013');


var_dump($processo[0]->classificacaoAssunto->assunto);
```

