<?php
namespace App\core\controllers;



class BaseRoutes{

public function __construct(){


}

public function getClassAndMethodFromUrl($urlPath){
    $class='';
    $method='';
    $routes =$this->getRoutes();

    $urlPath='/'. $this->trimPathSlashes($urlPath);

    if(array_key_exists($urlPath,$routes)){
        $classWithMethod=$routes[$urlPath]['class'];
        return explode('@',$classWithMethod);
    }


    $urlPathArray=explode('/',$urlPath);


    $method=$urlPathArray[count($urlPathArray)-1];
    unset($urlPathArray[count($urlPathArray)-1]);

    unset($urlPathArray[0]);

    $class=join('/',$urlPathArray);



    return [$class,$method];
}

    public function trimPathSlashes($path){
       return preg_replace(['/^[\s\/]*[^\w\d\_\-\@]*/','/[\s\/]*[^\w\d\_\-\@]*$/'],['',''],$path);

    }

    public function getUrlFromAlias($alias){
        $routes =$this->getRoutes();
        $alias=trim($alias);
        foreach($routes as $key=>$value){
            if(trim($value['alias'])==$alias) return $key;
        }

        return 'route not exist';
    }

}