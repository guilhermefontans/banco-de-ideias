<?php

namespace BancoIdeias\controller;

use Silex\Application;
use BancoIdeias\model\UsuarioDao;
use BancoIdeias\model\PremioDao;
use BancoIdeias\model\PremioRetiradoDao;
use BancoIdeias\model\AreaDao;
use BancoIdeias\model\Usuario;

/**
 * Class LoginController
 * @author Guilherme
 */
class UsuarioController
{
    public function cadastrar(Application $app)
    {
        try{
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
                    "email"   => request()->get('email'),
                    "area"   => request()->get('area'),
                    "pontos" => request()->get('pontos'),
                    "isadmin" => $admin,
                    "senha" => password_hash(
                        request()->get('senha'),
                        PASSWORD_BCRYPT
                    )
                )
            );
        } catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'usuario/add');
        }
        session()->set('info', 'Usuário cadastrado com sucesso!');
        return $app->redirect(URL_AUTH . 'usuario');
    }

    public function alterar(Application $app, $codigo)
    {
        try{
            $dao = new UsuarioDao();
            $usuarioDB = $dao->byId($codigo);
            $usuario = new Usuario();
            $usuario->mount($usuarioDB);
            $dao = new AreaDao();
            $areas = $dao->find();
        } catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'usuario');
        }
        return view()->render(
            'usuario/usuarioform.twig',
            ['usuario' => $usuario, 'areas' => $areas]
        );
    }

    public function update(Application $app, $codigo)
    {
        try{
            $dao = new UsuarioDao();

            $admin = false;
            if (request()->get('isadmin')) {
                 $admin = true;
            }

            $dao->update(
                array(
                    'codigo', '=', $codigo
                ),
                array(
                    "login"   => request()->get('login'),
                    "nome"   => request()->get('nome'),
                    "email"   => request()->get('email'),
                    "area"   => request()->get('area'),
                    "pontos" => request()->get('pontos'),
                    "isadmin" => $admin
                )
            );
        } catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'usuario/add');
        }
        session()->set('info', 'Usuário alterado com sucesso!');
        return $app->redirect(URL_AUTH . 'usuario');
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
        try{
            $dao = new UsuarioDao();
            $dao->delete(array('codigo', '=', $codigo));
        }catch (\Exception $ex) {
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'usuário');
        }
        session()->set('info', 'Usuário apagado com sucesso!');
        return $app->redirect(URL_AUTH . 'usuario');
    }

    public function restrict(Application $app)
    {
        return view()->render('pages/restrict.twig');
    }

    public static function atualizarPontosInSession($codigoUsuario)
    {
        $usuarioDao = new UsuarioDao();
        $userDao = $usuarioDao->byId($codigoUsuario);
        session()->set('pontos', $userDao->pontos);
    }

    public function solicitarPremio(Application $app, $codigoPremio, $pontos, $codigoUsuario)
    {
        try{
            $usuarioDao = new UsuarioDao();
            $userDb = $usuarioDao->byId($codigoUsuario);
            $user = new Usuario();
            $user->mount($userDb);
            $usuarioDao->update(
                array(
                    'codigo', '=', $codigoUsuario
                ),
                array(
                    "pontos"   => $user->getPontos() -  $pontos
                )
            );
            $premioRetiradoDao = new PremioRetiradoDao();
            $premioRetiradoDao->insert(
                array(
                    "codigo_usuario" => $codigoUsuario,
                    "codigo_premio" => $codigoPremio,
                    "data_retirada"   => date('Y-m-d H:i:s')
                )
            );

            $admins = $usuarioDao->getAdmins();
            $premioDao = new PremioDao();
            $premio = $premioDao->byId($codigoPremio);

            foreach ($admins as $admin) {
                mail(
                    $admin->email,
                    "Solicitação de prêmio",
                    "Olá, o usuário ".$user->getNome() . " solicitou o prêmio: " . $premio->nome,
                    "From: Banco de Ideias <system@bancodeideias.org>"
                );
            }
        } catch (\Exception $ex){
            session()->set('error', $ex->getMessage());
            return $app->redirect(URL_AUTH . 'premio');
        }
        session()->set('info', 'Prêmio solicitado com sucesso!');
        return $app->redirect(URL_AUTH . 'premio');
    }
}
