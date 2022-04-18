<?php

require_once('./dao/FruitDAO.php');
require_once('./model/Fruit.php');
require_once('./components/FruitComponents.php');
require_once ('views/header.php');
require_once('utils/SanitizationService.php');

my_error_logging_principles();

$fruitDAO = new FruitDAO();
$purifier=new SanitizationService();
$fruit = null;

if (isset($_POST["id"])){
    $id = $_POST["id"];
    if(!is_numeric($id)){
      die();
    }
    $fruit = $fruitDAO->getFruitById($id);  
   }
   else {
          return("<html>Fruit id is missing</html>");
    }
  
   $FruitComponents = new FruitComponents();

?>




<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<?php print_head() ?>
<body>  
<div class="container">    
 <?php
        $navigation=getNavigation();
        echo $navigation
        
 ?>
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Edit</h1>
        <?php
        
        $FruitComponents->printEditFruitForm($fruit); 
        
        ?>
    </div> 
</div>  
</body></html>