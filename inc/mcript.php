<?php

//Configuración del algoritmo de encriptación

//Debes cambiar esta cadena, debe ser larga y unica
//nadie mas debe conocerla
$clave  = "Asysteco_QR-generator?2020&C4R10S&P3DR0&4IvaR4S";

//Metodo de encriptación
$method = 'aes-256-cbc';
/*
Genera un valor para IV
*/
$getIV = function () use ($method) {
    return base64_decode(base64_encode(openssl_cipher_iv_length($method)));
};
$iv = date('YYmmdd');

/*
Encripta el contenido de la variable, enviada como parametro.
*/
$encriptar = function ($valor) use ($method, $clave, $iv) {
    return openssl_encrypt ($valor, $method, $clave, false, $iv);
};

/*
Desencripta el texto recibido
*/
$desencriptar = function ($valor) use ($method, $clave, $iv) {
    $encrypted_data = base64_decode($valor);
    return openssl_decrypt($valor, $method, $clave, false, $iv);
};
 

