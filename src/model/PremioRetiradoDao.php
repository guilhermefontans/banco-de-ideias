<?php

namespace BancoIdeias\model;
use BancoIdeias\model\Dao;

class PremioRetiradoDao extends Dao
{
    public function __construct()
    {
        parent::__construct("premio_retirado");
    }
}
