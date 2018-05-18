<?php
namespace App\core\controllers;


class BaseModules{

    protected $moduleName='';

    protected $indexViewPath='';

    public function __construct(){



    }




    public function renderViewOrDefault($viewPath,$defaulViewName,$params){

        extract($params);

        extract(include _BASEFILE_.'/config/main.php');

        if(file_exists($viewPath)){
            include $viewPath;
        }else{
            include _BASEFILE_.'/default/views/'.$defaulViewName.'.php';
        }
    }

}
