<?php

namespace Src\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Services\EventService;
use Src\Services\ThemeService;
use Src\Services\TypeService;
use Src\Services\UsersService;
use Src\Services\Page;

class ServiceController extends Controller{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);

        // Verifica se o redirecionamento foi feito e retorna a resposta
        // if ($response->getStatusCode() === 302) {
        // return $response;
        // }

        $events = new EventService();

        $data = $events->quantityEvents(date('Y'),date('m'),date('d'));

        $page = new Page();

        $page->setTpl('dashboard',[
            'month' => $data['eventsMonth'],
            'week' => $data['eventsWeek'],
            'day' => $data['eventsDay']
        ]);

        return $response;

    }

    public function loadTheme(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);

        $data = $request->getParsedBody();

        $theme = new ThemeService();

        $results = $theme->listAll($data);
        
        $response = ['status' => true,
                     'data' => $results];

        return json_encode($response);

    }

    public function loadType(ServerRequestInterface $request, ResponseInterface $response, array $args){
    
        UsersService::verifyLogin($response);


        $data = $request->getParsedBody();

        $type = new TypeService();

        $results = $type->listAll($data);
        
        $response = ['status' => true,
                    'data' => $results];

        return json_encode($response);

    }

     public function loadCalendar(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);
 
        $event = new EventService();
        $results = $event->getEvents();

        $responseData = [
            'status' => true,
            'data' => $results
        ];
        
        // $response = ['status' => true,
        //             'data' => $results];

        // return json_encode($response);

        // Retorna a resposta como JSON e define o cabeçalho adequado
        $response->getBody()->write(json_encode($responseData));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);

    }

   

} 