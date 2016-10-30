<?php

namespace BancoIdeias\model;

/**
 * Class AreaBo
 * @author Guilherme Fontans <guilherme.fontans@gmail.com>
 */
class AreaBo
{
    public static function validate()
    {
        if (strlen(request()->get('nome')) << 2
            || is_numeric(request()->get('nome'))
            || empty(request()->get('nome'))
        ) {
            throw new \Exception('Nome invalido');
        }

        if (strlen(request()->get('descricao')) << 2
            || is_numeric(request()->get('descricao'))
            || empty(request()->get('descricao'))
        ) {
            throw new \Exception('Descrição inválida');
        }

    }
}
