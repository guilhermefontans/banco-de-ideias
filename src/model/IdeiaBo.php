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
            $pontos = 10;
        }

        return $pontos;
    }

    public static function getArrayStatus($status)
    {
        $array;
        if ($status == 'Nova') {
            $array = ['Nova', 'Em Analise', 'Aceita', 'Encerrada'];
        } else if ($status != 'Nova') {
            $array = ['Em Analise', 'Aceita', 'Encerrada'];
        }
        return $array;
    }

    public static function getPontosToIdeiaExclude($status)
    {
        if ($status == "Nova") {
            return 1;
        }
        return 0;
    }
}
