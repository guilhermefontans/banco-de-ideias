<?php

namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\AreaDao;
use BancoIdeias\model\Area;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class LoginController
 * @author yourname
 */
class AreaController
{
    public function cadastrar(Application $app)
    {
        $dao = new AreaDao();
        $return = $dao->insert(
            array(
                "codigo" => null,
                "nome"   => request()->get('nome'),
                "descricao" => request()->get('descricao')
            )
        );

        return $app->redirect(URL_BASE . 'area');
    }

    public function alterar(Application $app, $codigo)
    {
        $dao = new AreaDao();
        $areaDB = $dao->byId($codigo);
        $area = new Area();
        $area->mount($areaDB);
        return view()->render('area/areaform.twig', ['area' => $area]);
    }

    public function update(Application $app, $codigo)
    {
        $dao = new AreaDao();
        $return = $dao->update(
            array(
                'codigo', '=', $codigo
            ),
            array(
                "nome"   => request()->get('nome'),
                "descricao" => request()->get('descricao')
            )
        );

        return $app->redirect(URL_BASE . 'area');
    }

    public function add(Application $app)
    {
        return view()->render('area/areaform.twig');
    }

    public function all(Application $app)
    {
        $dao = new AreaDao();
        $areas = $dao->find();
        $app['monolog']->addInfo(print_r($areas, true));
        return view()->render('area/area.twig',['areas' => $areas]);
    }

    public function delete(Application $app, $codigo)
    {
        $dao = new AreaDao();
        $dao->delete(array('codigo', '=', $codigo));
        return $app->redirect(URL_BASE . 'area');
    }
}
