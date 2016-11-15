<?php
/**
 * Controller Area
 */
namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\AreaDao;
use BancoIdeias\model\Area;
use BancoIdeias\model\AreaBo;

/**
 * Class AreaController
 *
 * @category 
 * @package  Controller
 * @author   Guilherme Fontans <guilherme.fontans@gmail.com>
 */
class AreaController
{
    public function cadastrar(Application $app)
    {
        try{
            AreaBo::validate();
            $dao = new AreaDao();
            $dao->insert(
                array(
                    "codigo" => null,
                    "nome"   => request()->get('nome'),
                    "descricao" => request()->get('descricao')
                )
            );
        } catch (\Exception $ex){
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'area/add');
        }
        session()->set('info', 'Área cadastrada com sucesso!');
        return $app->redirect(URL_AUTH . 'area');
    }

    public function alterar(Application $app, $codigo)
    {
        try{
            $dao = new AreaDao();
            $areaDB = $dao->byId($codigo);
            $area = new Area();
            $area->mount($areaDB);
        } catch (\Exception $ex){
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'area');
        }
        return view()->render('area/areaform.twig', ['area' => $area]);
    }

    public function update(Application $app, $codigo)
    {
        try{
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
        }catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'area/add');
        }
        session()->set('info', 'Área atualizada com sucesso!');
        return $app->redirect(URL_AUTH . 'area');
    }

    public function add(Application $app)
    {
        return view()->render('area/areaform.twig');
    }

    public function all(Application $app)
    {
        $dao = new AreaDao();
        $areas = $dao->find();
        return view()->render('area/area.twig', ['areas' => $areas]);
    }

    public function delete(Application $app, $codigo)
    {
        try{
            $dao = new AreaDao();
            $dao->delete(array('codigo', '=', $codigo));
        }catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'area');
        }
        session()->set('info', 'Área apagada com sucesso!');
        return $app->redirect(URL_AUTH . 'area');
    }
}
