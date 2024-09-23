<?php

namespace Src\Controllers; 

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Src\Models\Event;
use Src\Services\Page;
use Src\Services\CategoryService;
use Src\Services\TypeService;
use Src\Services\UsersService;
use Src\Services\BrandService;

class TypeController extends Controller{
    
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;

        $product = new TypeService();

        $product->setData($_POST);

        $pagination = $product->getPages($pages,8);

        $result = $this->verifyPages($pagination,$pages);

        $page = new Page();


        $page->setTpl('type_search',[
            'type'=>$pagination['data'],
            'pages'=>$result['pages'],
            'more'=>$result['more'],
            'alert' => self::getMessage(),
            'filter' => $_POST,
        ]);

    }

    public function viewCreate(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);

        $page = new Page();
    
        $page->setTpl('type',[
            'alert' => self::getMessage(),
            'link' => '/tipos/create',
        ]);

    }

    public function viewUpdate(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);
        
        $type = new TypeService();

        $page = new Page();

        $values = $type->load($args['id']);

        $page->setTpl('type',[
            'alert' => self::getMessage(),
            'type' => $values[0],
            'link' => "/tipos/update/$args[id]",
        ]);

    }

    public function update(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);

        $type = new TypeService();

        $type->setData($_POST);

        $result = $type->update($args['id']);

        if(!$result){
            self::setMessage('Preencha todos os campos.','warning');
            Controller::redirect('/tipos/update/'.$args['id']);
        }

        self::setMessage('Registro atualizado com sucesso.','success');
        Controller::redirect('/tipos');

    }

    public function create(ServerRequestInterface $request, ResponseInterface $response, array $args){

        //print_r($_POST);exit;

        UsersService::verifyLogin($response);

        $type = new TypeService();

        $type->setData($_POST);

        $result = $type->save();

        if(!$result){
            self::setMessage('Preencha todos os campos.','warning');
            Controller::redirect('/tipos/create');
        }

        self::setMessage('Registro cadastrado com sucesso.','success');
        Controller::redirect('/tipos');

    }

    public function delete(ServerRequestInterface $request, ResponseInterface $response, array $args){

        UsersService::verifyLogin($response);

        $type = new TypeService();

        $result = $type->delete($args['id']);

        if(!$result){
            self::setMessage('Não foi possível excluir o registro!','warning');
            Controller::redirect('/tipos');
        }

        self::setMessage('Registro excluído com sucesso.','success');
        Controller::redirect('/tipos');

    }



}