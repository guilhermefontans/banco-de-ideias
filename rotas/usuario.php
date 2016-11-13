<?php
$ctrl = BancoIdeias\controller\UsuarioController::class;

$auth->get('/usuario', "$ctrl::all");
$auth->get('restrict/', "$ctrl::restrict");
$auth->get('/usuario/add', "$ctrl::add");
$auth->get('/usuario/delete/{codigo}', "$ctrl::delete");
$auth->get('/usuario/alterar/{codigo}', "$ctrl::alterar");
$auth->post('/usuario/cadastrar', "$ctrl::cadastrar");
$auth->post('/usuario/update/{codigo}', "$ctrl::update");
