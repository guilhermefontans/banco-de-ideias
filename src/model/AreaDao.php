<?php

namespace BancoIdeias\model;
use BancoIdeias\model\Dao;

class AreaDao extends Dao
{
    public function __construct()
    {
        parent::__construct("area");
    }
}
