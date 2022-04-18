<?php

require('./components/FruitSaleComponents.php');

class FruitComponents {

     function __construct() {
        $this->fruitSaleComponents=new FruitSaleComponents();
    }

public $fruitSaleComponents;


static function getFruitForm(){
    return "<div>".  
            "<form method='post' action='index.php'>". 
            "<div class='form-group'>". 
            "<label for='name'>Name *</label>". 
            "<input type='text' class='form-control' name='name' /></div>".
            "<div class='form-group'>". 
            "<label for='diameter'>Diameter *</label>". 
            "<input type='text' class='form-control' name='diameter' /> </div>".
            "<div class='form-group'>". 
            "<label for='description'>Description</label>". 
            "<input type='text' class='form-control' name='description' /> </div>".
            "<button type='submit' name='action' value='addNewFruit' class='btn btn-primary'>Add fruit</button>".
            "</form>".
        "</div>";
}

function printEditFruitForm($fruit){
    ##echo print_r($fruit);
    echo "<div>".  
            "<form method='post' action='index.php'>". 
            "<div class='form-group'>". 
            "<input type='hidden' name='id' value ='".$fruit->id."'>".
            "<input type=\"hidden\" name=\"action\" value =\"updateFruit\">".
            "<label for=\"name\">Name *</label>". 
            "<input type=\"text\" class=\"form-control\" name=\"name\" value=\"".$fruit->name."\"/> </div>".
            "<div class=\"form-group\">". 
            "<label for=\"diameter\">Diameter *</label>". 
            "<input type=\"text\" class=\"form-control\" name=\"diameter\" value=\"".$fruit->diameter."\"/> </div>".
            "<div class=\"form-group\">". 
            "<label for=\"description\">Description</label>". 
            "<input type='text' class='form-control' name='description' value='".$fruit->description."'/> </div>".
            "<button type=\"submit\" class=\"btn btn-primary\">Save</button>".
            "</form>".
        "</div>";
}

function getNewFruitButton(){
    return '<a style="margin: 19px;" href="add_fruit.php" class="btn btn-primary">
        Add new fruit</a>';
}

function getEditFruitButton($fruitid){
   return '<form action="edit_fruit.php" method="post"> 
           <input type="hidden" name="id" value="'.$fruitid.'">
           <button class="btn btn-secondary" type="submit">Edit</button> 
           </form>';
}

function getDeleteFruitButton($fruitid){
    return '<form action="index.php" method="post">
            <input type="hidden" name="id" value="'.$fruitid.'">
            <button class="btn btn-danger" name="action" value="deleteFruit" type="submit">Delete</button> 
            </form>';
}

function printFruitsComponent($fruits){
    ##echo print_r($fruits);
    echo "<table class='table table-striped'>".
            "<thead>".
                "<tr>".
                    "<th>ID</th>".
                    "<th>Name</th>".
                    "<th>Diameter</th>".
                    "<th>Description</th>".
                    "<th colspan=3 style='vertical-align: center'>Options</th>".
                "</tr>".
            "</thead>".
            "<tbody>";
            foreach($fruits as $fruit){  
                $newFruitSaleButton = $this->fruitSaleComponents->getFruitSalesButton($fruit->id);
                $editFruitButton = $this->getEditFruitButton($fruit->id);
                $deleteFruitButton = $this->getDeleteFruitButton($fruit->id);

                echo "<tr>".
                    "<td>".$fruit->id."</td>".
                    "<td>".$fruit->name."</td>".
                    "<td>".$fruit->diameter."</td>".
                    "<td>".$fruit->description."</td>".
                    "<td>".$newFruitSaleButton."</td>".
                    "<td>".$editFruitButton."</td>".
                    "<td>".$deleteFruitButton."</td>".
                "</tr>";
            };
                echo "</tbody></table>";
}
}