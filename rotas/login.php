<?php
$ctrl = BancoIdeias\controller\LoginController::class;

#$app->get('/', "$ctrl::index");

$app->post('/', "$ctrl::index");
$app->post('/login/verify', "$ctrl::login");
$auth->get('/home', "$ctrl::home");
