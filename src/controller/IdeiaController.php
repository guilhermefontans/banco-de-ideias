<?php

namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\IdeiaDao;
use BancoIdeias\model\AreaDao;
use BancoIdeias\model\Ideia;

/**
 * Class LoginController
 * @author Guilherme
 */
class IdeiaController
{
    public function cadastrar(Application $app)
    {
        $dao = new IdeiaDao();
        $admin = false;
        if (request()->get('isadmin')) {
             $admin = true;
        }
        $return = $dao->insert(
            array(
                "codigo" => null,
                "login"   => request()->get('login'),
                "nome"   => request()->get('nome'),
                "area"   => request()->get('area'),
                "pontos" => request()->get('pontos'),
                "isadmin" => $admin,
                "senha" => password_hash(
                    request()->get('senha'),
                    PASSWORD_BCRYPT
                )
            )
        );

        return $app->redirect(URL_AUTH . 'ideia');
    }

    public function alterar(Application $app, $codigo)
    {
        $dao = new IdeiaDao();
        $ideiaDB = $dao->byId($codigo);
        $ideia = new ideia();
        $ideia->mount($ideiaDB);
        $dao = new AreaDao();
        $areas = $dao->find();
        return view()->render(
            'ideia/ideiaform.twig',
            ['ideia' => $ideia, 'areas' => $areas]
        );
    }

    public function update(Application $app, $codigo)
    {
        $dao = new IdeiaDao();

        $admin = false;
        if (request()->get('isadmin')) {
             $admin = true;
        }

        $return = $dao->update(
            array(
                'codigo', '=', $codigo
            ),
            array(
                "login"   => request()->get('login'),
                "nome"   => request()->get('nome'),
                "area"   => request()->get('area'),
                "pontos" => request()->get('pontos'),
                "isadmin" => $admin
            )
        );

        return $app->redirect(URL_AUTH . 'ideia');
    }

    public function add(Application $app)
    {
        $dao = new AreaDao();
        $areas = $dao->find();

        return view()->render(
            'ideia/ideiaform.twig',
            ['areas' => $areas]
        );
    }

    public function all(Application $app)
    {
        $dao = new IdeiaDao();
        $ideias = $dao->join(
            array(
                'join' => array(
                    'area',
                    'area.codigo',
                    'ideia.area'
                ),
                'fields' => array(
                    'ideia.*',
                    'area.nome AS area'
                )
            )
        );

        return view()->render(
            'ideia/ideia.twig',
            ['ideias' => $ideias]
        );
    }

    public function delete(Application $app, $codigo)
    {
        $dao = new IdeiaDao();
        $dao->delete(array('codigo', '=', $codigo));
        return $app->redirect(URL_AUTH . 'ideia');
    }
}
