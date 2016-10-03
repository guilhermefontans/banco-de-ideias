<?php

namespace BancoIdeias\model;
use BancoIdeias\model\Connection;

abstract class Dao
{
    private $tableName;
    private $rs=NULL;
    private $rowsSelectaffected;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }
    public function insert($fields, $values)
    {
        try
        {
            //faz a conexão com o BD
            Connection::connect();

            //monta o comando INSERT
            $sql = "INSERT INTO $this->tableName ($fields) VALUES
                    ($values)";
            echo $sql;
            //abrir a transação
            Connection::getConn()->beginTransaction();
            //Executa o comando no Banco e
            //retorna a qtde de linhas afetadas
            $rows_affected=
                Connection::getConn()->exec($sql);

            //efetivar a transação
            Connection::getConn()->commit();

            //encerra a conexão
            Connection::disconnect();

            return $rows_affected;
        }
        catch(Exception $ex)
        {
            Connection::getConn()->rollBack();
            throw $ex;
        }
    }
    public function update($fieldsValues, $filter)
    {

        try
        {
            //faz a conexão com o BD

            Connection::connect();

            $filterOrigin = $filter;
            if ($filter != "")
                $filter = "WHERE $filter";

            //monta o comando UPDATE
            $sql = "UPDATE $this->tableName SET $fieldsValues $filter ";
            //echo $sql;
            //abrir a transação
            Connection::getConn()->beginTransaction();

            //Executa o comando no Banco e
            //retorna a qtde de linhas afetadas
            $rows_affected=
                Connection::getConn()->exec($sql);

            //efetivar a transação
            Connection::getConn()->commit();

            Connection::disconnect();

            return $rows_affected;
        }
        catch(Exception $ex)
        {
            Connection::getConn()->rollBack();
            throw $ex;
        }
    }

    public function delete($filter)
    {
        try
        {
            //abrir conexão
            Connection::connect();

            if ($filter != "")
                $filter = "WHERE $filter";

            //monta o comando DELETE
            $sql="DELETE FROM
              $this->tableName $filter";
            //echo $sql;

            //abrir a transacao
            Connection::getConn()->beginTransaction();

            //Executa o comando no Banco e
            //retorna a qtde de linhas afetadas
            $rows_affected=
                Connection::getConn()->exec($sql);

            //efetivar a transacao
            Connection::getConn()->commit();

            Connection::disconnect();

            return $rows_affected;
        }
        catch(Exception $ex)
        {
            Connection::getConn()->rollBack();
            throw $ex;
        }
    }
    public function find($columns, $filter)
    {
        try
        {
            //faz a conexão com o BD
            Connection::connect();

            if ($filter != "")
                $filter = "WHERE $filter";

            $sql = "SELECT $columns FROM
                    $this->tableName
                     $filter ";
            //echo $sql;

            $this->rs=
             Connection::getConn()->query($sql);

            $this->rowsSelectaffected=
               $this->rs->rowCount();

            Connection::disconnect();

            return $this->rowsSelectaffected;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }
    public function findJoin($query)
    {
        try
        {
            //faz a conexão com o BD
            Connection::connect();

            $sql = "$query";
            //echo $sql;

            $this->rs=
             Connection::getConn()->query($sql);

            $this->rowsSelectaffected=
               $this->rs->rowCount();

            Connection::disconnect();

            return $this->rowsSelectaffected;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }
    public function getRecordSet()
    {
        try
        {
            $return = NULL;

            if (!$this->rs){
                return NULL;
            }
                while($row=$this->rs->fetch())
                     $return[] = $row;
            //}
            return  $return;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
}