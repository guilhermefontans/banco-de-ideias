<?php

use BancoIdeias\auth\Auth;

$auth = $app['controllers_factory'];

require __DIR__ . '/rotas/area.php';
require __DIR__ . '/rotas/login.php';
require __DIR__ . '/rotas/usuario.php';
require __DIR__ . '/rotas/premio.php';
require __DIR__ . '/rotas/ideia.php';

// verificar a session
$app->get('/', function(){
    return view()->render('login/login.twig');
});

$app->get('/logout', function() use ($app){
    Auth::logout();
    return $app->redirect(URL_BASE);
});

$auth->before(function() use ($app) {
    if (!Auth::validate()) {
        return $app->redirect(URL_BASE);
    }
});

//Verifica se usurario tem permissão de edição
$auth->before(function() use ($app) {
    if (!Auth::isAdmin()) {
        $pattern = '/(add|delete|alterar|update)/';
        preg_match($pattern, $_SERVER['REQUEST_URI'], $matches);

        $app['monolog']->addInfo(print_r($matches, true));
        if($matches){
            return $app->redirect(URL_RESTRICT);
        }
    }
});

#// Monta as urls em 'auth/'
$app->mount('auth', $auth);
