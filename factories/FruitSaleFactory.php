<?php


class FruitSaleFactory {

public function createFruitSaleFromArray($array_fruit_sale) { 
            $fruit_sale = new FruitSale();

            if (isset($array_fruit_sale['id']))
                $fruit_sale->id=$array_fruit_sale['id'];
            if (isset($array_fruit_sale['price']))    
                $fruit_sale->price=$array_fruit_sale['price'];
            if (isset($array_fruit_sale['saledate'])){
                $fruit_sale->saledate=$array_fruit_sale['saledate'];
            }
            if (isset($array_fruit_sale['fruitid']))
                $fruit_sale->fruitid=$array_fruit_sale['fruitid'];
            return $fruit_sale;
       }

    public function createFruitSale($price, $saledate, $fruitid) {
            $fruit_sale = new FruitSale();
            $fruit_sale->fruitid = $fruitid;
            $fruit_sale->price = $price;
            $fruit_sale->saledate = $saledate;
            return $fruit_sale;
    }
}

?>