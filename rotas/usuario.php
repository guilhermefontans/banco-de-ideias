<?php
$ctrl = BancoIdeias\controller\UsuarioController::class;

$app->get('/usuario', "$ctrl::all");
$auth->get('/usuario/add', "$ctrl::add");
$app->get('/usuario/delete/{codigo}', "$ctrl::delete");
$app->get('/usuario/alterar/{codigo}', "$ctrl::alterar");
$app->post('/usuario/cadastrar', "$ctrl::cadastrar");
$app->post('/usuario/update/{codigo}', "$ctrl::update");
