<?php

namespace BancoIdeias\model;

/**
 * Class IdeiaBo
 *
 * @author Guilherme Fontans <guilherme.fontans@gmail.com>
 */
class IdeiaBo
{
    public static function getPontosToIdeia($status)
    {
        $pontos = 0;
        if ($status == 'Nova') {
            $pontos = 1;
        } else if ($status == 'Em Analise') {
            $pontos = 5;
        } else if ($status == 'Aceita') {
            $pontos = 5;
        } else if ($status == 'Excluida') {
            $pontos = -1;
        }

        return $pontos;
    }
}
