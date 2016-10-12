<?php

ini_set('display_errors', 1);

require __DIR__ . '/rotas/ideia.php';
require __DIR__ . '/rotas/area.php';
require __DIR__ . '/rotas/login.php';
require __DIR__ . '/rotas/premio.php';

// verificar a session
$app->get('/', function(){
    return view()->render('login/login.twig');
});

#$auth->get('/logout', function() use ($app){
#    BaseAuth::logout();
#    return $app->redirect(URL_BASE);
#});
#
#$auth->before(function () use ($app) {
#    if (!BaseAuth::validate()) {
#        return $app->redirect(URL_BASE);
#    }
#});
#
#// Monta as urls em 'auth/'
#$app->mount('auth', $auth);
