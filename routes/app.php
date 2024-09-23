<?php 

use Src\Controllers\LoginController;
use Src\Controllers\EventController;
use Src\Controllers\ServiceController;
use Src\Controllers\ThemeController;
use Src\Controllers\TypeController;

// $app->get('/', function($resquest, $response) {

//     if(isset($_SESSION['user'])) {
//         return $response->withRedirect('/');
//     } else {
//         return $response->withRedirect('/login');
//     }
// });

$app->get('/login', LoginController::class);
$app->post('/login', \Src\Controllers\LoginController::class . ':login');
$app->get('/logout', [LoginController::class,'logout']);




$app->map(['GET','POST'],'/', ServiceController::class);

// Products Group
$app->group('/eventos', function ($group){
    $group->map(['GET','POST'],'',EventController::class);
    $group->get('/create',[EventController::class,'viewCreate']);
    $group->post('/create',[EventController::class,'create']);
    $group->get('/update/{id}',[EventController::class,'viewUpdate']);
    $group->post('/update/{id}',[EventController::class,'update']);
    $group->get('/delete/{id}',[EventController::class,'delete']);
});

$app->group('/tipos', function ($group){
    $group->map(['GET','POST'],'',TypeController::class);
    $group->get('/create',[TypeController::class,'viewCreate']);
    $group->post('/create',[TypeController::class,'create']);
    $group->get('/update/{id}',[TypeController::class,'viewUpdate']);
    $group->post('/update/{id}',[TypeController::class,'update']);
    $group->get('/delete/{id}',[TypeController::class,'delete']);
});


$app->group('/temas', function ($group){
    $group->map(['GET','POST'],'',ThemeController::class);
    $group->get('/create',[ThemeController::class,'viewCreate']);
    $group->post('/create',[ThemeController::class,'create']);
    $group->get('/update/{id}',[ThemeController::class,'viewUpdate']);
    $group->post('/update/{id}',[ThemeController::class,'update']);
    $group->get('/delete/{id}',[ThemeController::class,'delete']);
});






