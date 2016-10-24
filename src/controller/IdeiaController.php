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
        $return = $dao->insert(
            array(
                "codigo" => null,
                "nome"   => request()->get('nome'),
                "descricao"   => request()->get('descricao'),
                "area"   => request()->get('area'),
                "usuario"   => session()->get('userCodigo'),
                "status"   => request()->get('status'),
                "data"   => date("Y-m-d H:i:s")
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
        $statusIdeia = ['Nova', 'Em Analise', 'Aceita', 'Cancelada'];
        return view()->render(
            'ideia/ideiaform.twig',
            ['ideia' => $ideia, 'areas' => $areas, 'statusIdeia' => $statusIdeia]
        );
    }

    public function update(Application $app, $codigo)
    {
        $dao = new IdeiaDao();
        
        $return = $dao->update(
            array(
                'codigo', '=', $codigo
            ),
            array(
                "descricao"   => request()->get('descricao'),
                "nome"   => request()->get('nome'),
                "area"   => request()->get('area'),
                "usuario" => request()->get('usuario'),
                "status" => request()->get('status'),
                "data" => request()->get('data')
            )
        );

        return $app->redirect(URL_AUTH . 'ideia');
    }

    public function add(Application $app)
    {
        $dao = new AreaDao();
        $areas = $dao->find();
        $statusIdeia = ['Nova', 'Em Analise', 'Aceita', 'Cancelada'];

        return view()->render(
            'ideia/ideiaform.twig',
            ['areas' => $areas, 'statusIdeia' => $statusIdeia]
        );
    }

    public function all(Application $app)
    {
        $dao = new IdeiaDao();
        $ideias = $dao->all(
            array(
                'join' => array(
                    'ideia',
                    'area.codigo',
                    'ideia.area',
                    'usuario',
                    'usuario.codigo',
                    'ideia.usuario',
                ),
                'fields' => array(
                    'ideia.*',
                    'area.nome AS area',
                    'usuario.nome AS usuario'
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
