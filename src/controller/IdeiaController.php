<?php
namespace BancoIdeias\controller;

use Silex\Application;
/**
 * Class IdeiaController
 * @author yourname
 */
class IdeiaController
{
    public function cadastrar()
    {
        return view()->render('ideia/cadastrar.twig');
    }
}
