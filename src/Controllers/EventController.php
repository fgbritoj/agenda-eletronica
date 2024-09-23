<?php

namespace Src\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Services\Page;
use Src\Services\EventService;
use Src\Services\ThemeService;
use Src\Services\TypeService;
use Src\Services\UsersService;


class EventController extends Controller{
    
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;

        $event = new EventService();

        $event->setData($_POST);

        $pagination = $event->getPages($pages,8);

        $result = $this->verifyPages($pagination,$pages);

        $page = new Page();

        $page->setTpl('event_search',[
            'event'=>$pagination['data'],
            'pages'=>$result['pages'],
            'more'=>$result['more'],
            'alert' => self::getMessage(),
            'filter' => $_POST,
        ]);

    }

    public function viewCreate(){

        UsersService::verifyLogin();

        $page = new Page();
    
        $page->setTpl('event',[
            'alert' => self::getMessage(),
            'link' => '/eventos/create',
        ]);

    }

    public function viewUpdate($request, $response, array $args){

        UsersService::verifyLogin();
        
        $event = new EventService();

        $page = new Page();

        $values = $event->load($args['id']);

        $page->setTpl('event',[
            'alert' => self::getMessage(),
            'event' => $values[0],
            'link' => "/eventos/update/$args[id]",
        ]);

    }

    public function update($request, $response, array $args){

        UsersService::verifyLogin();

        $event = new EventService();

        $event->setData($_POST);

        $result = $event->update($args['id']);

        if(!$result){
            self::setMessage('Preencha todos os campos.','warning');
            Controller::redirect('/eventos/update/'.$args['id']);
        }

        self::setMessage('Registro atualizado com sucesso.','success');
        Controller::redirect('/eventos');

    }

    public function create(){

        UsersService::verifyLogin();

        $event = new EventService();

        $event->setData($_POST);

        $result = $event->save();

        if(!$result){
            self::setMessage('Preencha todos os campos.','warning');
            Controller::redirect('/eventos/create');
        }

        self::setMessage('Registro cadastrado com sucesso.','success');
        Controller::redirect('/eventos');

    }

    public function delete($request, $response, array $args){

        UsersService::verifyLogin();

        $event = new EventService();

        $result = $event->delete($args['id']);

        if(!$result){
            self::setMessage('Não foi possível excluir o registro!','warning');
            Controller::redirect('/eventos');
        }

        self::setMessage('Registro excluído com sucesso.','success');
        Controller::redirect('/eventos');

    }



}