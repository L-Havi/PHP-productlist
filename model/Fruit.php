<?php

require_once ('views/header.php');

my_error_logging_principles();

class Fruit {

    public $id;
    public $name;
    public $diameter;
    public $description;

    public static function checkFruit($name, $diameter, $description){
        if ($name==null || $description==null){
            return false;
        }
        if ($name=="" || $description=""){
            return false;
        }
        if ($diameter!=null){
            if (!is_numeric($diameter)){
                return false;
        }
        }
        return true;
    }

    
}

?>