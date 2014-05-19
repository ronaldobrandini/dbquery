<?php
namespace db;
abstract class SqlTransaction{

    private static $conn;
    private static $logger;

    public static function open($database){
        if(empty(self::$conn)){
            self::$conn = SqlConnection::open($database);
            self::$conn->beginTransaction();
            self::$logger = NULL;
        }
    }

    public static function get(){
        return self::$conn;
    }

    public static function rollback(){
        if(self::$conn){
            self::$conn->rollback();
            self::$conn = NULL;
        }
    }

    public static function close(){
        if(self::$conn){
            self::$conn->commit();
            self::$conn = NULL;
        }
    }

    public static function setLogger(SqlLogger $logger){
        self::$logger = $logger;
    }

    public static function log($message){
        // verifica existe um logger
        if(self::$logger){
            self::$logger->write($message);
        }
    }

}
