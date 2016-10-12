<?php
$ctrl = BancoIdeias\controller\AreaController::class;

$app->get('/area', "$ctrl::all");
$app->get('/area/add', "$ctrl::add");
$app->get('/area/delete/{codigo}', "$ctrl::delete");
$app->get('/area/alterar/{codigo}', "$ctrl::alterar");
$app->post('/area/cadastrar', "$ctrl::cadastrar");
$app->post('/area/update/{codigo}', "$ctrl::update");
