<?php

define("_BASEFILE_", dirname( __FILE__));
define("_PROJECTSUBFOLDER_",dirname($_SERVER['SCRIPT_NAME']));
//var_dump($_SERVER);die();
include 'vendor/autoload.php';
require _BASEFILE_.'/core/core/loadClasses.php';