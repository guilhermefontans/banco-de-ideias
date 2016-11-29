<?php

namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\IdeiaDao;
use BancoIdeias\model\IdeiaBo;
use BancoIdeias\model\AreaDao;
use BancoIdeias\model\UsuarioDao;
use BancoIdeias\model\Ideia;
use BancoIdeias\model\Usuario;
use BancoIdeias\controller\UsuarioController;

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
        try{
            $ideiaDao = new IdeiaDao();
            $usuarioDao = new UsuarioDao();
            $usuario = new Usuario();
            $usuario->mount($usuarioDao->byId(session()->get('userCodigo')));
            $pontosAfterInsert = $usuario->getPontos() + IdeiaBo::getPontosToIdeia(request()->get('status'));
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
            $usuarioDao->update(
                array('codigo', '=', $usuario->getCodigo()),
                array("pontos" => $pontosAfterInsert)
            );
        } catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'ideia/add');
        }
        session()->set('info', 'Ideia cadastrada com sucesso!'); 
        session()->set('pontos', $pontosAfterInsert);
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
        try{
            $dao = new IdeiaDao();
            $ideiaDB = $dao->byId($codigo);
            $ideia = new ideia();
            $ideia->mount($ideiaDB);
            $dao = new AreaDao();
            $areas = $dao->find();
            $statusIdeia = IdeiaBo::getArrayStatus($ideia->getStatus());
        } catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'ideia');
        }

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
        try{
            $dao = new IdeiaDao();
            $usuarioDao = new UsuarioDao();
            $ideiaDb = new Ideia();
            $ideiaDb->mount($dao->byId($codigo));
            $usuario = new Usuario();
            $usuario->mount($usuarioDao->byId($ideiaDb->getUsuario()));
            $pontosAfterInsert = $usuario->getPontos() + IdeiaBo::getPontosToIdeia(request()->get('status'));
            $dao->update(
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

            $usuarioDao->update(
                array('codigo', '=', $usuario->getCodigo()),
                array("pontos" => $pontosAfterInsert)
            );
        } catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'ideia/add');
        }
        session()->set('info', 'Ideia atualizada com sucesso!'); 
        session()->set('pontos', $pontosAfterInsert);
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
        try{
            $dao = new IdeiaDao();

            $ideiaDb = $dao->byId($codigo);
            $ideia = new Ideia();
            $ideia->mount($ideiaDb);
            $usuarioDao = new UsuarioDao();
            $usuario = new Usuario();
            $usuario->mount($usuarioDao->byId($ideia->getUsuario()));
            $dao->delete(array('codigo', '=', $codigo));
            $pontosAfterExclude = $usuario->getPontos() - IdeiaBO::getPontosToIdeiaExclude($ideia->getStatus());
            $usuarioDao->update(
                array(
                    'codigo', '=', $usuario->getCodigo()
                ),
                array(
                    "pontos" => $pontosAfterExclude
                )
            );
        }catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'ideia');
        }
        session()->set('info', 'Ideia apagada com sucesso!');
        session()->set('pontos', $pontosAfterExclude);

        return $app->redirect(URL_AUTH . 'ideia');
    }

    public function relatorio(Application $app)
    {
        $relat = '/usr/share/nginx/html/banco-de-ideias/public/relatorio.html';
        file_put_contents($relat, $this->all($app));
        $file = function () use ($app, $relat) {
            echo $app['snappy']->getOutPut('/usr/share/nginx/html/banco-de-ideias/public/relatorio.html');
            unlink($relat);
        };
        return $app->stream($file, 200, [
            'Content-Type' => 'application/pdf'
        ]);
    }
}
