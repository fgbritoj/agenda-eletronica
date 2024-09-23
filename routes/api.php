<?php 

use Src\Controllers\ServiceController;

// $app->group('/api', function ($app){

//     $app->post('/load/type', [ServiceController::class,'loadType']);
//     $app->post('/load/theme', [ServiceController::class,'loadTheme']);
//     // $app->post('/load/calendar', [ServiceController::class,'loadCalendar']);
//     $app->post('/load/calendar', \Src\Controllers\ServiceController::class . ':loadCalendar');

    
// });

$app->group('/api', function () use ($app) {
    $app->post('/load/type', 'Src\Controllers\ServiceController:loadType');
    $app->post('/load/theme', 'Src\Controllers\ServiceController:loadTheme');
    $app->post('/load/calendar', 'Src\Controllers\ServiceController:loadCalendar');
});







