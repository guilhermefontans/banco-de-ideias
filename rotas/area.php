<?php
$ctrl = BancoIdeias\controller\AreaController::class;

$auth->get('/area', "$ctrl::all");
$auth->get('/area/add', "$ctrl::add");
$auth->get('/area/delete/{codigo}', "$ctrl::delete");
$auth->get('/area/alterar/{codigo}', "$ctrl::alterar");
$auth->get('/area/pdf', "$ctrl::relatorio");
$auth->post('/area/cadastrar', "$ctrl::cadastrar");
$auth->post('/area/update/{codigo}', "$ctrl::update");
