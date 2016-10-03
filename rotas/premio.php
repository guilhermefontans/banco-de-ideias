<?php
$ctrl = BancoIdeias\controller\PremioController::class;

#$app->get('/', "$ctrl::index");

$app->get('/premio', "$ctrl::all");
$app->get('/premio/add', "$ctrl::add");
$app->get('/premio/delete/{codigo}', "$ctrl::delete");
$app->post('/premio/cadastrar', "$ctrl::cadastrar");
