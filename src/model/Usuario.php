<?php

namespace BancoIdeias\model;

/**
 * Class Usuario
 * @author yourname
 */
class Usuario
{
    private $codigo;
    private $nome;
    private $area;
    private $pontos;
    private $senha;
    private $isAdmin;

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

    /**
     * Get area.
     *
     * @return area.
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set area.
     *
     * @param area the value to set.
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     * Get isAdmin.
     *
     * @return isAdmin.
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set isAdmin.
     *
     * @param isAdmin the value to set.
     */
    public function setIsAdmin($isAdmin)
    {
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
    }

    /**
     * Get senha.
     *
     * @return senha.
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set senha.
     *
     * @param senha the value to set.
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
}
