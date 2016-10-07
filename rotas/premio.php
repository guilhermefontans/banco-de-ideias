<?php
$ctrl = BancoIdeias\controller\PremioController::class;

#$app->get('/', "$ctrl::index");

$app->get('/premio', "$ctrl::all");
$app->get('/premio/add', "$ctrl::add");
$app->get('/premio/delete/{codigo}', "$ctrl::delete");
$app->get('/premio/alterar/{codigo}', "$ctrl::alterar");
$app->post('/premio/cadastrar', "$ctrl::cadastrar");
$app->post('/premio/update/{codigo}', "$ctrl::update");
