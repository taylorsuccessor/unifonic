<?php
namespace  App\core\tools;


class Main {



    public function loadFilesFromArray($files){

        foreach($files as $key=>$file){

            $file=_BASEFILE_.'/'.$file;
            if(file_exists($file)){

                require $file;

            }else{
                throw new Exception("the file  (".$file.") does not exists");
            }



        }

    }

public  function getUrlPath(){
return str_replace(_PROJECTSUBFOLDER_,'',$_SERVER['REQUEST_URI']);
}

    public function replaceFSlashWithBSlash($string){
       return preg_replace('/\//','\\',$string);
    }

    public function replaceBSlashWithFSlash($string){
        return preg_replace('/\\/','/',$string);
    }

public function replaceFunctionMethod($functionName){
    $requestMethod=$_SERVER['REQUEST_METHOD'];

    $requestMethod=($requestMethod =='POST')? 'post':'get';

    if(preg_match('/^['.preg_quote('get').']|^['.preg_quote('post').']/',$functionName)){
        $functionName=preg_replace('/^['.preg_quote('get').']/',$requestMethod,$functionName) ;
    }elseif($requestMethod == 'post'){
        $functionName='post'.ucfirst ($functionName);
    }

return $functionName;
}

}

