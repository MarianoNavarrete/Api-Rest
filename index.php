<?php

$allowedResourceTypes = [
    'books',
    'authors',
    'genres',
];
$resourceType = $_GET['resource_type'];

if( !in_array($resourceType, $allowedResourceTypes )){
    die;
}

switch (strtoupper( $_SERVER['REQUEST_METHOD'])) {
        case 'GET':
        break;
        case 'POST':
        break;
        case 'PUT':
        break;
        case 'DELETE':
        break;
}