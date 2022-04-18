<?php


class FruitSaleComponents {

function getFruitSaleForm($fruitid){
    return "<div>".  
            "<form method=\"post\" action=\"fruitsales.php\">". 
            "<div class=\"form-group\">". 
            "<input type=\"hidden\" name=\"fruitid\" value=\"".$fruitid."\">".
            "<label for=\"price\">Price:</label>". 
            "<input type=\"text\" class=\"form-control\" name=\"price\" /> </div>".
            "<div class=\"form-group\">". 
            "<label for=\"saledate\"> Sale date (yyyy-mm-dd):</label>". 
            "<input type=\"text\" class=\"form-control\" name=\"saledate\" /> </div>".
            "<button type=\"submit\" class=\"btn btn-primary\" name=\"action\" value =\"addNewFruitSale\">Add sale</button>".
            "</form>".
        "</div>";
}


function printNewFruitSaleButton($fruitid){
    echo "<form method='post' action='add_fruit_sale.php'>". 
            "<input type='hidden' name='fruitid' value='".$fruitid."'>".
            "<div class='form-group'>". 
            "<button type='submit' class='btn btn-primary'>Add sale</button>".
            "</form>".
        "</div>";
}

function getFruitSalesButton($fruitid){
    return "<form method=\"post\" action=\"fruitsales.php\">". 
            "<input type='hidden' name='fruitid' value='".$fruitid."'>".
            "<div class='form-group'>". 
            "<button type='submit' class='btn btn-primary'>Show sales</button>".
            "</form>".
        "</div>";
}

function printFruitSalesComponent($fruitSales){
    echo "<table class='table table-striped'>".
            "<thead>".
                "<tr>".
                    "<th>ID</th>".
                    "<th>Sale date</th>".
                    "<th>Price</th>".
                    "<th style='vertical-align: center'>Options</th>".
                "</tr>".
            "</thead>".
            "<tbody>";
            foreach($fruitSales as $fruitSale){  
                echo "<tr>".
                    "<td>".$fruitSale->id."</td>".
                    "<td>".$fruitSale->saledate."</td>".
                    "<td>".$fruitSale->price."</td>".
                    "<td>".
                        "<form action='fruitsales.php' method='post'>". 
                        "<input type='hidden' name='id' value='".$fruitSale->id."'>".
                        "<input type='hidden' name='fruitid' value='".$fruitSale->fruitid."'>".
                        "<button class='btn btn-danger' name='action' value='deleteFruitSale' type='submit'>Delete</button>". 
                        "</form>".
                    "</td>".
                "</tr>";
            };
                echo "</tbody></table>";
}
}