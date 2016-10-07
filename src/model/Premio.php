<?php

namespace BancoIdeias\model;

/**
 * Class Premio
 * @author yourname
 */
class Premio
{
    private $codigo;
    private $nome;
    private $pontos;

    public function mount($obj)
    {
        foreach($obj as $key => $val) {
            $this->$key = $val;
        }
    }

    /**
     * Get codigo.
     *
     * @return codigo.
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set codigo.
     *
     * @param codigo the value to set.
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Get nome.
     *
     * @return nome.
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set nome.
     *
     * @param nome the value to set.
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Get pontos.
     *
     * @return pontos.
     */
    public function getPontos()
    {
        return $this->pontos;
    }

    /**
     * Set pontos.
     *
     * @param pontos the value to set.
     */
    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
    }
}
