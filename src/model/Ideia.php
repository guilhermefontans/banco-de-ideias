<?php

namespace BancoIdeias\model;

/**
 * Class Ideia
 * @author Guilherme Fontans
 */
class Ideia
{

    private $codigo;
    private $nome;
    private $descricao;
    private $area;
    private $status;
    private $usuario;
    private $data;

    /**
     * Mount Object
     *
     * @param obj the object of database
     */
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
     * Get status.
     *
     * @return status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status.
     *
     * @param status the value to set.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get usuario.
     *
     * @return usuario.
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set usuario.
     *
     * @param usuario the value to set.
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get data.
     *
     * @return data.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set data.
     *
     * @param data the value to set.
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
