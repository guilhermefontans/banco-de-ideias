<?php

namespace BancoIdeias\auth;

use BancoIdeias\models\Usuario;

class Auth
{
    public function login($senha, $senhaUser)
    {
        return password_verify($senha, $senhaUser);
    }

    public function grant()
    {
        session()->set('logged', true);
        session()->register('40 min');
    }

    public static function validate()
    {
        session()->valid();
        if (!session()->has('logged')) {
            return false;
        }
        return true;
    }

    public static function logout()
    {
        session()->destroy();
    }

    public static function isAdmin()
    {
        if (!session()->get('userType')) {
            return false;
        }
        return true;
    }
}
