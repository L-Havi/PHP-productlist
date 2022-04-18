<?php

require_once ('views/header.php');

my_error_logging_principles();

class FruitSale {

    public $id;
    public $price;
    public $saledate;
    public $fruitid;





    public static function checkFruitSale($price, $saledate, $fruitid){
        //echo $price. " ".$saledate." ".$fruitid;
        if ($price==null || $saledate==null || $fruitid==null){
            return false;
        }
        if ($saledate==""){
            return false;
        }
        if (!is_numeric($fruitid) || !is_numeric($price)){
          return false;
        }
        $dt = DateTime::createFromFormat('Y-m-d', $saledate);
        if ($dt==null){
            return false;
        }
        return true;
    }

}

?>