<?php

if(!isset($composer_running)){
spl_autoload_register(function($className){

   require_once preg_replace(["/^".preg_quote('App')."/","/\\\/"],[_BASEFILE_,"/"],$className) .'.php';

});
}

include _BASEFILE_.'/core/tools/globalFunctions.php';

$foldersAndFiles=include _BASEFILE_.'/core/config/foldersAndFiles.php';


//$coreClasses=include _BASEFILE_.'/core/config/coreClasses.php';

//require _BASEFILE_.'/core/tools/Main.php';
$MainTools = new App\core\tools\Main();

//$MainTools->loadFilesFromArray($coreClasses);






//require _BASEFILE_.'/'.$foldersAndFiles['mainRoutes'];

$routesClass = new  App\routes\routes();
$routesArray =$routesClass->getRoutes();

//global $routesClass;


$urlPath=$MainTools->getUrlPath();

list($class,$method)=$routesClass->getClassAndMethodFromUrl($urlPath);



//require _BASEFILE_.'/'.$foldersAndFiles['modulesDir'].'/'.$class.'.php';


$method=$MainTools->replaceFunctionMethod($method);


eval($MainTools->replaceFSlashWithBSlash('
$oClass=new App/'.$foldersAndFiles['modulesDir'].'/'.$class.'();
$oClass->'.$method.'();'));
