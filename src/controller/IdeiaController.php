<?php

namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\IdeiaDao;
use BancoIdeias\model\IdeiaBo;
use BancoIdeias\model\AreaDao;
use BancoIdeias\model\UsuarioDao;
use BancoIdeias\model\Ideia;
use BancoIdeias\model\Usuario;

/**
* Class LoginController
*
* @author Guilherme <guilherme.fontans@gmail.com>
*
*/
class IdeiaController
{

    /**
    * Register new Ideia
    *
    * @param Application $app application silex
    *
    * @return url
    */
    public function cadastrar(Application $app)
    {
        $ideiaDao = new IdeiaDao();
        $usuarioDao = new UsuarioDao();
        $usuario = new Usuario();
        $usuario->mount($usuarioDao->byId(session()->get('userCodigo')));
        $ideiaDao->insert(
            array(
                "codigo" => null,
                "nome"   => request()->get('nome'),
                "descricao"   => request()->get('descricao'),
                "area"   => request()->get('area'),
                "usuario"   => $usuario->getCodigo(),
                "status"   => request()->get('status'),
                "data"   => date("Y-m-d H:i:s")
            )
        );
        $a = IdeiaBo::getPontosToIdeia('Nova');
        $usuarioDao->update(
            array(
                'codigo', '=', $usuario->getCodigo()
            ),
            array(
                "pontos" => $usuario
                    ->getPontos() + IdeiaBO::getPontosToIdeia(
                        request()
                        ->get('status')
                    )
            )
        );

        return $app->redirect(URL_AUTH . 'ideia');
    }

    /**
    * Render form to update Ideia
    *
    * @param Application $app    application silex
    * @param int         $codigo code of Ideia
    *
    * @return url
    */
    public function alterar(Application $app, $codigo)
    {
        $dao = new IdeiaDao();
        $ideiaDB = $dao->byId($codigo);
        $ideia = new ideia();
        $ideia->mount($ideiaDB);
        $dao = new AreaDao();
        $areas = $dao->find();
        $statusIdeia = ['Nova', 'Em Analise', 'Aceita', 'Encerrada'];
        return view()->render(
            'ideia/ideiaform.twig',
            ['ideia' => $ideia, 'areas' => $areas, 'statusIdeia' => $statusIdeia]
        );
    }

    /**
    * Update Ideia
    *
    * @param Application $app    application silex
    * @param int         $codigo code of Ideia
    *
    * @return url
    */
    public function update(Application $app, $codigo)
    {
        $dao = new IdeiaDao();
        $ideiaDb = new Ideia();
        $ideiaDb->mount($dao->byId($codigo));
        $return = $dao->update(
            array(
                'codigo', '=', $codigo
            ),
            array(
                "descricao"   => request()->get('descricao'),
                "nome"   => request()->get('nome'),
                "area"   => request()->get('area'),
                "usuario" => $ideiaDb->getUsuario(),
                "status" => request()->get('status'),
                "data" => $ideiaDb->getData()
            )
        );

        return $app->redirect(URL_AUTH . 'ideia');
    }

    /**
    * Render form to Ideia
    *
    * @param Application $app application silex
    *
    * @return url
    */
    public function add(Application $app)
    {
        $dao = new AreaDao();
        $areas = $dao->find();

        return view()->render(
            'ideia/ideiaform.twig',
            ['areas' => $areas]
        );
    }

    /**
    * Get all ideias
    *
    * @param Application $app application silex
    *
    * @return url
    */
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


    /**
    * Delete ideia
    *
    * @param Application $app    application silex
    * @param int         $codigo code of Ideia
    *
    * @return url
    */
    public function delete(Application $app, $codigo)
    {
        $dao = new IdeiaDao();
        $dao->delete(array('codigo', '=', $codigo));
        return $app->redirect(URL_AUTH . 'ideia');
    }
}
