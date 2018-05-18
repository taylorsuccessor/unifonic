<?php
namespace App\core\database;

use App\core\database\DatabaseInterface;
use PDO;
use SQLite3;
class SqliteDatabase implements DatabaseInterface{

    private static $connection=null;
    public function __construct($config)
    {
        if(self::$connection !=null){return $this;}

        self::connect($config['location']);

        return $this;
    }

    public static function connect($location){
        try {
            $conn =new SQLite3($location);
            self::$connection=$conn;
            return true;
        }
        catch(Exception $e)
        {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }

    }

    public static function query($sql){
       $result = self::$connection->query($sql);

            return $result;

    }
}