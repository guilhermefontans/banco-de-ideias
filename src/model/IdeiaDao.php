<?php

namespace BancoIdeias\model;
use BancoIdeias\model\Dao;
use BancoIdeias\model\Connection;
use Illuminate\Database\Capsule\Manager as DB;


class IdeiaDao extends Dao
{
    public function __construct()
    {
        parent::__construct("ideia");
    }

    public function all($parameters = array())
    {

        return DB::table('area')
            ->join(
                $parameters['join'][0],
                $parameters['join'][1],
                '=',
                $parameters['join'][2]
            )
            ->join(
                $parameters['join'][3],
                $parameters['join'][4],
                '=',
                $parameters['join'][5]
            )
            ->select(
                $parameters['fields'][0],
                $parameters['fields'][1],
                $parameters['fields'][2]
            )
            ->get();
    }
}
