<?php


class FruitFactory {

     public function createFruitFromArray($array_fruit) {
        $fruit = new Fruit();
        if (isset($array_fruit['id']))
            $fruit->id=$array_fruit['id'];
        if (isset($array_fruit['name']))    
            $fruit->name=$array_fruit['name'];
        if (isset($array_fruit['diameter']))
            $fruit->diameter=$array_fruit['diameter'];
        if (isset($array_fruit['description']))
            $fruit->description=$array_fruit['description'];
        return $fruit;
    }
      
    public function createFruit($name, $diameter, $description, $id=null) {
        $fruit = new Fruit();
        $fruit->id = $id;
        $fruit->name = $name;
        $fruit->diameter = $diameter;
        $fruit->description = $description;
        return $fruit;
    }
}

?>