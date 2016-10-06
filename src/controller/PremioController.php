<?php
namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\PremioDao;
use Illuminate\Database\Capsule\Manager as DB;
/**
 * Class LoginController
 * @author yourname
 */
class PremioController
{
    public function cadastrar(Application $app)
    {
        $dao = new PremioDao();
        $return = $dao->insert(
            array(
                "codigo" => null,
                "nome"   => request()->get('nome'),
                "pontos" => request()->get('pontos')
            )
        );

        return $app->redirect(URL_BASE . 'premio');
    }

    public function alterar(Application $app, $codigo)
    {
        $dao = new PremioDao();
        $return = $dao->update(
            array(
                'codigo', '=', $codigo
            ),
            array(
                "nome"   => request()->get('nome'),
                "pontos" => request()->get('pontos')
            )
        );

        return $app->redirect(URL_BASE . 'premio');
    }

    public function add(Application $app)
    {
        return view()->render('premio/add.twig');
    }

    public function all(Application $app)
    {
        $dao = new PremioDao();
        $premios = $dao->find();
        return view()->render('premio/premio.twig',['premios' => $premios]);
    }

    public function delete(Application $app, $codigo)
    {
        $dao = new PremioDao();
        $dao->delete(array('codigo', '=', $codigo));
        return $app->redirect(URL_BASE . 'premio');
    }
}
