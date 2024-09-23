<?php

session_start();


require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true, // Ativa a exibição de detalhes de erros
    ],
];

$app = new \Slim\App($configuration);

$dotenv = Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();


require_once __DIR__ . '/routes/app.php';
require_once __DIR__ . '/routes/api.php';


$app->run();