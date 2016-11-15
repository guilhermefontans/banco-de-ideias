<?php
$ctrl = BancoIdeias\controller\PremioController::class;

#$app->get('/', "$ctrl::index");

$auth->get('/premio', "$ctrl::all");
$auth->get('/premio/add', "$ctrl::add");
$auth->get('/relatorio', "$ctrl::relatorio");
$auth->get('/premio/delete/{codigo}', "$ctrl::delete");
$auth->get('/premio/alterar/{codigo}', "$ctrl::alterar");
$auth->post('/premio/cadastrar', "$ctrl::cadastrar");
$auth->post('/premio/update/{codigo}', "$ctrl::update");
