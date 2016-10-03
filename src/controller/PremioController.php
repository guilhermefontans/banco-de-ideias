<?php
namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\Connection;
use BancoIdeias\model\PremioDao;
/**
 * Class LoginController
 * @author yourname
 */
class PremioController
{
    public function cadastrar(Application $app)
    {
        Connection::connect();
        $dao = new PremioDao();
        $nome = request()->get('nome');
        $pontos = request()->get('pontos');
        $return = $dao->insert("codigo, nome, pontos", "'null','$nome', '$pontos'");
        print $return;
        return $app->redirect(URL_BASE . 'premio');
    }

    public function add(Application $app)
    {
        return view()->render('premio/add.twig');
    }

    public function all()
    {
        Connection::connect();
        $dao = new PremioDao();
        $linhas=$dao->find("codigo,nome,pontos",'');

        if ($linhas==0) {
            return view()->render('premio/add.twig');
        } else {
            $premios = $dao->getRecordSet();
            return view()->render('premio/premio.twig',['premios' => $premios]);
        }
    }

    public function delete(Application $app, $codigo)
    {
        Connection::connect();
        $dao = new PremioDao();
        /* if ($dao->delete($codigo)) { */
        /*     return $app->redirect(URL_BASE . 'premio'); */
        /* } */
        $dao->delete("codigo=$codigo");
        return $app->redirect(URL_BASE . 'premio');
    }

}
