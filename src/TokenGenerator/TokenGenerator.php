<?php

namespace PHPSigad\TokenGenerator;

use Jose\Component\Encryption\Serializer\CompactSerializer;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Encryption\Algorithm\KeyEncryption\RSAOAEP256;
use Jose\Component\Encryption\Algorithm\ContentEncryption\A128GCM;
use Jose\Component\Encryption\Compression\CompressionMethodManager;
use Jose\Component\Encryption\Compression\Deflate;
use Jose\Component\Encryption\JWEBuilder;
use Jose\Component\KeyManagement\JWKFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

//Criei uma função que gera o token bear, então sempre que eu vou me comunicar com o sigad qnd eu gero um bear novo.

//Segue abaixo a função comentada:

class TokenGenerator
{
    function getToken($username) {

    // The key encryption algorithm manager with the A256KW algorithm.
    $keyEncryptionAlgorithmManager = new AlgorithmManager([
        new RSAOAEP256(),
    ]);

    // The content encryption algorithm manager with the A256CBC-HS256 algorithm.
    $contentEncryptionAlgorithmManager = new AlgorithmManager([
        new A128GCM(),
    ]);

    // The compression method manager with the DEF (Deflate) method.
    $compressionMethodManager = new CompressionMethodManager([
        new Deflate(),
    ]);

    $jweBuilder = new JWEBuilder(
        $keyEncryptionAlgorithmManager, $contentEncryptionAlgorithmManager, $compressionMethodManager
    );


    //aqui eu carrego a chave que o Cassia do sigad me passou, ai tem uma pra ambiente de homologação e outra para produção,
    // a chave eu salvei ela em um arquivo texto e salvei com o formato .pem   

    $jwk = JWKFactory::createFromKeyFile($_ENV['PEM_FILE_DIR']);
    
    $payload = json_encode([
        'exp' => time() + 6000,//tempo que o token irá expirar
        "iss" => $_ENV['SISTEMA'],
        "sub" =>  $username,//usuário logado, todos meus sistemas já estão com a autenticação central, entao uso o e-mail do usuário, mas lembrando que para funcionar o usuário precisa estar cadastrado no sistema do sigad
        'iat' => time(),
        'nbf' => time(),
        //aqui eu criei uma função para gerar número aleatório no formato aceito pelo jti, na sequencia vc encontra esta função
        'jti' => self::gen_uuid()
    ]);


    
    $jwe = $jweBuilder
            ->create()              // We want to create a new JWE
            ->withPayload($payload) // We set the payload
            ->withSharedProtectedHeader([
                'alg' => 'RSA-OAEP-256', // Key Encryption Algorithm
                'enc' => 'A128GCM'//,
                    // 'zip' => 'DEF' // Content Encryption Algorithm
            ])
            ->addRecipient($jwk)    // We add a recipient (a shared key or public key).
            ->build();              // We build it



        $serializer = new CompactSerializer(); // The serializer


        $token = $serializer->serialize($jwe, 0); // We serialize the recipient at index 0 (we only have one recipient).

        return $token;
    }

    //aqui gero o valor para o jti 
    //A declaração "jti" (JWT ID) fornece um identificador exclusivo para o JWT. O valor do identificador DEVE ser atribuído de uma maneira que garanta que haja uma probabilidade insignificante de que o mesmo valor seja acidentalmente atribuído a um objeto de dados

    static function gen_uuid() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                // 16 bits for "time_mid"
                mt_rand(0, 0xffff),
                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand(0, 0x0fff) | 0x4000,
                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand(0, 0x3fff) | 0x8000,
                // 48 bits for "node"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
