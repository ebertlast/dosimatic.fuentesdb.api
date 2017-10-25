<?php
namespace App\Lib;
use Exception;
// use PDOException;
class Database
{
    public static function StartUp($dbhost, $dbname, $dbuser="", $dbpass="") {
        try {
            $conn = new \Slim\PDO\Database("mysql:host=$dbhost;dbname=$dbname;charset=utf8",$dbuser,$dbpass);
            // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // throw new Exception("Conexión Establecida");
            // $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
            return $conn;
        // }catch(PDOException $e){
            // throw ($e);
        }catch(Exception $e) {
            throw ($e);
        } 
        return $conn;
    }
}
