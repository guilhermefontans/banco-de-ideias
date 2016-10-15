<?php
namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\UsuarioDao;
/**
 * Class LoginController
 * @author yourname
 */
class LoginController
{
    /* public function login(Application $app) */
    /* { */
    /*     return $app->redirect(URL_BASE . 'home'); */
    /* } */
    public function login(Application $app)
    {
        $dao = new UsuarioDao();
        $login = request()->get('login');
        $senha = request()->get('senha');
        $user = $dao->find(array("login", "=", request()->get('login')));
        $app['monolog']->addInfo(print_r($user, true));
        if ($user) {
            if ($this->checkHash(request()->get('senha'), $user[0]->senha)) {
                return $app->redirect(URL_BASE . 'home');
            }
            return false;
        }
    }

    public function checkHash($senha, $hash)
    {
        return password_verify($senha, $hash);
    }

    public function home(Application $app)
    {
        return view()->render('pages/home.twig');
    }

    public function index(){
        return view()->render('login/login.twig');
    }
}
