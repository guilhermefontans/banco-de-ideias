<?php

namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\UsuarioDao;
use BancoIdeias\model\Usuario;
use BancoIdeias\auth\Auth;

/**
 * Class LoginController
 * @Guilherme Fontans
 */
class LoginController
{
    public function login(Application $app)
    {
        $dao = new UsuarioDao();
        $auth = new Auth();
        $login = request()->get('login');
        $senha = request()->get('senha');
        $userDao = $dao->find(array("login", "=", request()->get('login')));
        if ($userDao) {
            $user = new Usuario();
            $user->mount($userDao[0]);
            if ($auth->login(request()->get('senha'), $user->getSenha())) {
                session()->set('userName', $user->getNome());
                session()->set('userCodigo', $user->getCodigo());
                session()->set('userType', $userDao[0]->isadmin);
                session()->set('pontos', $userDao[0]->pontos);
                $app['monolog']->addInfo(print_r($_SESSION, true));
                $auth->grant();
                return $app->redirect(URL_AUTH . 'home');
            }
        }
        session()->set('error', 'Usuário ou senha inválido');
        return $app->redirect(URL_BASE);
    }

    public function home(Application $app)
    {
        return view()->render('pages/home.twig');
    }

    public function index()
    {
        return view()->render('login/login.twig');
    }
}
