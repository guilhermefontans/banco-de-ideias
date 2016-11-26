<?php
namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\PremioDao;
use BancoIdeias\controller\UsarioController;
use BancoIdeias\model\Premio;
use BancoIdeias\model\PremioBo;

/**
 * Class PremioController
 * @author Guilherme Fontans <guilherme.fontans@gmail.com>
 */
class PremioController
{
    public function cadastrar(Application $app)
    {
        try {
            PremioBo::validate();
            $dao = new PremioDao();
            $dao->insert(
                array(
                    "codigo" => null,
                    "nome"   => request()->get('nome'),
                    "pontos" => request()->get('pontos')
                )
            );
        } catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'premio/add');
        }
        session()->set('info', 'Prêmio cadastrado com sucesso!'); 
        return $app->redirect(URL_AUTH . 'premio');
    }

    public function alterar(Application $app, $codigo)
    {
        try{
            $dao = new PremioDao();
            $premioDB = $dao->byId($codigo);
            $premio = new Premio();
            $premio->mount($premioDB);
        } catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'premio');
        }
        return view()->render('premio/premioform.twig', ['premio' => $premio]);
    }

    public function update(Application $app, $codigo)
    {
        try{
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
        }catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'premio/add');
        }
        session()->set('info', 'Prêmio atualizado com sucesso!'); 
        return $app->redirect(URL_AUTH . 'premio');
    }

    public function add(Application $app)
    {
        return view()->render('premio/premioform.twig');
    }

    public function all(Application $app)
    {
        $codigo = session()->get('userCodigo');
        $app['monolog']->addInfo($codigo);
        UsuarioController::atualizarPontosInSession($codigo);
        $dao = new PremioDao();
        $premios = $dao->find();
        return view()->render('premio/premio.twig',['premios' => $premios]);
    }

    public function delete(Application $app, $codigo)
    {
        try{
            $dao = new PremioDao();
            $dao->delete(array('codigo', '=', $codigo));
        }catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'premio');
        }
        session()->set('info', 'Prêmio apagado com sucesso!');
        return $app->redirect(URL_AUTH . 'premio');
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
