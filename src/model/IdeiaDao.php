<?php

namespace BancoIdeias\model;
use BancoIdeias\model\Dao;

class IdeiaDao extends Dao
{
    public function __construct()
    {
        parent::__construct("ideia");
    }
}
