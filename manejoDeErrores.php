<?php

$ch = curl_init($argv[1]);
curl_setopt(
    $ch,
        CURLOPT_RETURNTRANSFER,
        true
);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
switch($httpCode){
        case 200:
            echo 'todo bien';
            echo $httpCode;
        break;
        case 400:
            echo 'pedido incorrecto';
        break;
        case 500:
            echo 'el servidor fallo';
}