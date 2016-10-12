<?php

namespace BancoIdeias\model;

/**
 * Class Area
 * @author yourname
 */
class Area
{
    private $codigo;
    private $nome;
    private $descricao;

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
     * Get descricao.
     *
     * @return descricao.
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set descricao.
     *
     * @param descricao the value to set.
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
}
