<?php
namespace App\core\database;

use App\core\database\DatabaseInterface;
use PDO;

class MysqlDatabase implements DatabaseInterface{

    private static $connection=null;
    public function __construct($config)
    {
        if(self::$connection !=null){return $this;}

        self::connect($config['servername'],$config['$database'],$config['username'],$config['password']);

        return $this;
    }

    public static function connect($servername,$database,$username,$password){
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection=$conn;
            return true;
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }

    }

    public static function query($sql){
       $result = self::$connection->exec($sql);

        return $result;
    }
}