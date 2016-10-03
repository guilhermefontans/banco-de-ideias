<?php

namespace BancoIdeias\model;

class Connection
{

    private static $conn;
    /**
     * método para conectar no bd
     *
    */
    public static function connect()
    {
        try
        {
          self::$conn = new \PDO(DSN, USER, PASS);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }

    }
    //encerra a conexão com o servidor de BD
    public static function disconnect()
    {
        self::$conn = null;
    }
    /**
     * 
     */
    public static function getConn()
    {
        return self::$conn;
    }
}
?>
