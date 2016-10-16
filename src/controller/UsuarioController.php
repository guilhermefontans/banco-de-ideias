<?php

namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\UsuarioDao;
use BancoIdeias\model\AreaDao;
use BancoIdeias\model\Usuario;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class LoginController
 * @author Guilherme
 */
class UsuarioController
{
    public function cadastrar(Application $app)
    {
        $dao = new UsuarioDao();
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

        return $app->redirect(URL_BASE . 'usuario');
    }

    public function alterar(Application $app, $codigo)
    {
        $dao = new UsuarioDao();
        $usuarioDB = $dao->byId($codigo);
        $usuario = new Usuario();
        $usuario->mount($usuarioDB);
        $dao = new AreaDao();
        $areas = $dao->find();
        return view()->render(
            'usuario/usuarioform.twig',
            ['usuario' => $usuario, 'areas' => $areas]
        );
    }

    public function update(Application $app, $codigo)
    {
        $dao = new UsuarioDao();

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

        return $app->redirect(URL_BASE . 'usuario');
    }

    public function add(Application $app)
    {
        $dao = new AreaDao();
        $areas = $dao->find();

        return view()->render(
            'usuario/usuarioform.twig',
            ['areas' => $areas]
        );
    }

    public function all(Application $app)
    {
        $dao = new UsuarioDao();
        $usuarios = $dao->join(
            array(
                'join' => array(
                    'area',
                    'area.codigo',
                    'usuario.area'
                ),
                'fields' => array(
                    'usuario.*',
                    'area.nome AS area'
                )
            )
        );

        return view()->render(
            'usuario/usuario.twig',
            ['usuarios' => $usuarios]
        );
    }

    public function delete(Application $app, $codigo)
    {
        $dao = new UsuarioDao();
        $dao->delete(array('codigo', '=', $codigo));
        return $app->redirect(URL_BASE . 'usuario');
    }
}
