<?php

namespace BancoIdeias\model;

/**
 * Class PremioBo
 * @author Guilherme Fontans <guilherme.fontans@gmail.com>
 */
class PremioBo
{
    public static function validate()
    {
        if (strlen(request()->get('nome')) < 2
            || is_numeric(request()->get('nome'))
            || empty(request()->get('nome'))
        ) {
            throw new \Exception('Nome invalido');
        }

        if (!is_numeric(request()->get('pontos'))
            || empty(request()->get('pontos'))
        ) {
            throw new \Exception('Pontos inválidos');
        }

    }
}
