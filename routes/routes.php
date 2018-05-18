<?php
namespace  App\routes;

use App\core\controllers\BaseRoutes;

class routes extends BaseRoutes{






public function  getRoutes(){

    return array(
        '/'=>array('alias'=>'index','class'=>'register/controllers/Main@index'),

    );
}

}