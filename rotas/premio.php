<?php
$ctrl = BancoIdeias\controller\PremioController::class;

$auth->get('/premio', "$ctrl::all");
$auth->get('/premio/add', "$ctrl::add");
$auth->get('/premio/delete/{codigo}', "$ctrl::delete");
$auth->get('/premio/alterar/{codigo}', "$ctrl::alterar");
$auth->get('/premio/pdf', "$ctrl::relatorio");
$auth->post('/premio/cadastrar', "$ctrl::cadastrar");
$auth->post('/premio/update/{codigo}', "$ctrl::update");
