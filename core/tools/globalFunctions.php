<?php


function printFieldErrorList($field,$errorList){
    if(array_key_exists($field,$errorList)){
        foreach($errorList[$field] as $error){
            echo '<p style="color:red;" >'.$error.'</p>';
        }
    }
}


