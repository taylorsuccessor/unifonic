<?php

namespace App\core\database;
use App\core\database\MysqlDatabase;
use App\core\database\SqliteDatabase;
class ConnectDatabase{

    private static $db=null;

    private static function setDatabase()
    {
        $config=include _BASEFILE_.'/config/database.php';

        if($config['databaseType']=='mysql'){
            self::$db = new MysqlDatabase($config['mysql']);
        }
        if($config['databaseType']=='sqlite'){
            self::$db = new SqliteDatabase($config['sqlite'] );
        }

    }


    public static function query($sql){
        if(self::$db ==null)
        {
            self::setDatabase();
        }
       return self::$db->query($sql);
    }
}