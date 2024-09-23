<?php

namespace Src\Controllers;

use Src\Services\Page;
use Src\Services\UsersService;

class LoginController extends Controller{
    
    public function __invoke(){
        
        $page = new Page([
            "header"=>false,
            "footer"=>false
        ]);
        
        $page->setTpl('login',[
            'alert' => self::getMessage() ?? ''
        ]);

    }

    public function login($request, $response){

        $result = UsersService::login($_POST['email'],$_POST['password']);

        if(!$result){
            self::setMessage('Usuário inexistente ou senha inválida!','warning');
            // Controller::redirect('/login');
            // return self::redirect($response, '/login');
            return $response->withRedirect('/login');

        }

        // Controller::redirect('/');
        // return self::redirect($response, '/');
        // return $response->withRedirect('/');

        $response = $response->withRedirect('/');
        return $response;
    }

    public function logout(){
            
        UsersService::logout();
        Controller::redirect('/login');

    }

}