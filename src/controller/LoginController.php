<?php
namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\Connection;
/**
 * Class LoginController
 * @author yourname
 */
class LoginController
{
    public function login(Application $app)
    {
        return $app->redirect(URL_BASE . 'home');
    }


    public function home(Application $app)
    {
        return view()->render('pages/home.twig');
    }

    public function index(){
        return view()->render('login/login.twig');
    }
}
