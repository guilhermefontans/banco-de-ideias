<?php
$ctrl = BancoIdeias\controller\IdeiaController::class;

$auth->get('/ideia', "$ctrl::all");
$auth->get('/ideia/add', "$ctrl::add");
$auth->get('/ideia/delete/{codigo}', "$ctrl::delete");
$auth->get('/ideia/alterar/{codigo}', "$ctrl::alterar");
$auth->get('/ideia/pdf', "$ctrl::relatorio");
$auth->post('/ideia/cadastrar', "$ctrl::cadastrar");
$auth->post('/ideia/update/{codigo}', "$ctrl::update");
