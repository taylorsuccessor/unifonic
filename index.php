<?php

define("_BASEFILE_", dirname( __FILE__));

$projectSubFolder=dirname($_SERVER['SCRIPT_NAME']);
$projectSubFolder=($projectSubFolder =='/')? '':$projectSubFolder;
define("_PROJECTSUBFOLDER_",$projectSubFolder);
//var_dump($_SERVER);die();
include 'vendor/autoload.php';
require _BASEFILE_.'/core/core/loadClasses.php';