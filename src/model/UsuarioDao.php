<?php

namespace BancoIdeias\model;
use BancoIdeias\model\Dao;

class UsuarioDao extends Dao
{
    public function __construct()
    {
        parent::__construct("usuario");
    }
}
