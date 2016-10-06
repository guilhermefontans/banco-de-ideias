<?php

namespace BancoIdeias\model;
use BancoIdeias\model\Connection;
use Illuminate\Database\Capsule\Manager as DB;

abstract class Dao
{
    private $tableName;
    private $rs=NULL;
    private $rowsSelectaffected;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function insert(array $values)
    {
        try{
            DB::beginTransaction();
            DB::table($this->tableName)->insert($values);
            DB::commit();
        } catch (Exception $ex){
            DB::rollback();
            throw $ex;
        }
    }

    public function update($filter = false, array $values)
    {
        try{
            DB::beginTransaction();

            if ( empty($filter) ){
               DB::table($this->tableName)->update($values);
            } else {
                DB::table($this->tableName)
                    ->where(
                        $filter[0],
                        $filter[1],
                        $filter[2]
                    )->update($values);
            }

            DB::commit();
        } catch (Exception $ex){
            DB::rollback();
            throw $ex;
        }
    }

    public function find($filter = false)
    {
        try{
            DB::beginTransaction();

            if ( empty($filter) ){
               $premios = DB::table($this->tableName)->get();
            } else {
                $premios = DB::table($this->tableName)
                    ->where(
                        $filter[0],
                        $filter[1],
                        $filter[2]
                    )->get();
            }

            DB::commit();
            return $premios;
        } catch (Exception $ex){
            DB::rollback();
            throw $ex;
        }
    }

    public function delete($filter = false)
    {
        try{
            DB::beginTransaction();

            if ( empty($filter) ){
               DB::table($this->tableName)->delete();
            } else {
                DB::table($this->tableName)
                    ->where(
                        $filter[0],
                        $filter[1],
                        $filter[2]
                    )->delete();
            }

            DB::commit();
        } catch (Exception $ex){
            DB::rollback();
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