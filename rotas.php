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

$auth->before(function() use ($app) {
    if (!Auth::isAdmin()) {
        return $app->redirect(URL_BASE);
    }
});

#// Monta as urls em 'auth/'
$app->mount('auth', $auth);
