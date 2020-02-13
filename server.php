<?php
//para inicializar el servidor se utiliza
// php -S localhost:9000 archivo.php
//para consumir el servicio http se utiliza 
// curl http://localhost9000?nombeDeLaVariable=1djfa

//autenticacion via http
/* $user = array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : '';
$pwd = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : '';

if($user !== 'mariano' || $pwd !== '1234'){
    echo ('no te puedo mostrar nada');
    die;
} */
//autenticacion via HMAC

/* if(
    !array_key_exists('HTTP_X_HASH',$_SERVER) ||
    !array_key_exists('HTTP_X_TIMESTAMP',$_SERVER) ||
    !array_key_exists('HTTP_X_UID',$_SERVER) 
){
    die;
} */
/* 
list($hash,  $uid, $timestamp) = [
    $_SERVER['HTTP_X_HASH'],
    $_SERVER['HTTP_X_TIMESTAMP'],
    $_SERVER['HTTP_X_UID'],
];

$secret = '1234';

$newHash = sha1($uid.$timestamp.$secret);

if($newHash !== $hash){
    die;
} */

$books = [
    1 => [
        'titulo' => 'lo que el viento se llevo',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    2 => [
        'titulo' => 'la iliada',
        'id_autor' => 1,
        'id_genero' => 1,
    ],
    3 => [
        'titulo' => 'cancion de fuego y hielo',
        'id_autor' => 3,
        'id_genero' => 3,
    ]
    ];
$allowedResourceTypes = [
    'books',
    'authors',
    'genres',
];
 // $resourceType = $_GET['resource_type'];
 /* if( !in_array($resourceType, $allowedResourceTypes )){
    http_response_code(400);
    die;1
}   */
//obtener el id
$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';


switch (strtoupper( $_SERVER['REQUEST_METHOD'])) {
        case 'GET':
            if(empty($resourceId)){
                echo json_encode($books) ;
            } else {
                if(array_key_exists( $resourceId, $books)){
                    echo json_encode($books[$resourceId]);
                } else {
                    http_response_code(500);
                }
            }
            //echo json_encode($books);
        break;
        case 'POST':
            $json = file_get_contents('php://input');
            $books[] = json_decode($json, true);
            
        break;
        case 'PUT':
            if(!empty($resourceId) && array_key_exists($resourceId,$books));
            {
                $json = file_get_contents('php://input');
                $books[$resourceId] = json_decode($json, true);

                echo json_encode($books);
            }
        break;

        case 'DELETE':
            if(!empty($resourceId) && array_key_exists($resourceId,$books));
            {
                //eliminando el recurso
                //echo json_encode($books[$resourceId]);
                unset($books[$resourceId]);
                
            }
            echo json_encode($books);
        break;
}