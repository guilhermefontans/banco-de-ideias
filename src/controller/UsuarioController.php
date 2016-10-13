<?php
namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\UsuarioDao;
use BancoIdeias\model\Usuario;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class LoginController
 * @author yourname
 */
class UsuarioController
{
    public function cadastrar(Application $app)
    {
        $dao = new UsuarioDao();
        $return = $dao->insert(
            array(
                "codigo" => null,
                "nome"   => request()->get('nome'),
                "area"   => request()->get('area'),
                "pontos" => request()->get('pontos'),
                "senha" => request()->get('senha'),
                "isadmin" => request()->get('isAdmin')
            )
        );

        return $app->redirect(URL_BASE . 'usuario');
    }

    public function alterar(Application $app, $codigo)
    {
        $dao = new UsuarioDao();
        $usuarioDB = $dao->byId($codigo);
        $usuario = new Usuario();
        $usuario->mount($usuarioDB);
        return view()->render('usuario/usuarioform.twig', ['usuario' => $usuario]);
    }

    public function update(Application $app, $codigo)
    {
        $dao = new UsuarioDao();
        $return = $dao->update(
            array(
                'codigo', '=', $codigo
            ),
            array(
                "nome"   => request()->get('nome'),
                "area"   => request()->get('area'),
                "pontos" => request()->get('pontos'),
                "isadmin" => request()->get('isAdmin')
            )
        );

        return $app->redirect(URL_BASE . 'usuario');
    }

    public function add(Application $app)
    {
        return view()->render('usuario/usuarioform.twig');
    }

    public function all(Application $app)
    {
        $dao = new UsuarioDao();
        $usuarios = $dao->find();
        return view()->render('usuario/usuario.twig',['usuarios' => $usuarios]);
    }

    public function delete(Application $app, $codigo)
    {
        $dao = new UsuarioDao();
        $dao->delete(array('codigo', '=', $codigo));
        return $app->redirect(URL_BASE . 'usuario');
    }
}
