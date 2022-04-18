<?php

//phpinfo();

require_once('./dao/FruitDAO.php');
require_once('./dao/FruitSaleDAO.php');
require_once('./model/Fruit.php');
require_once('./components/FruitComponents.php');
require_once('factories/FruitFactory.php');

require_once ('views/header.php');
require_once('utils/SanitizationService.php');

my_error_logging_principles();

$fruitDAO = new FruitDAO();
$fruitSaleDAO = new FruitSaleDAO();
$fruitFactory = new FruitFactory();
$fruitsComponents = new FruitComponents();

$purifier = new SanitizationService();
$navigation = getNavigation();

//Create tablet
//$fruitDAO->createFruitsTable();
//$fruitSaleDAO->createFruitSaleTable();

$status_text = "";
$error_text = "";

if (isset($_POST["action"])){
   $action = $_POST["action"];
   
  
   if ($action == "addNewFruit"){
    try {
       $p_fruit_name = $purifier->sanitizeHtml($_POST['name']);
       $p_fruit_diameter = $purifier->sanitizeHtml($_POST['diameter']);
       $p_fruit_description = $purifier->sanitizeHtml($_POST['description']);
       $fruit_ok=Fruit::checkFruit($p_fruit_name, $p_fruit_diameter, $p_fruit_description);
       if(!$fruit_ok){
         $error_text="Check input fields";
       }
       else {
         $fruit = $fruitFactory->createFruit($p_fruit_name, $p_fruit_diameter, $p_fruit_description);
         $result = $fruitDAO->addFruit($fruit);
         $status_text = "Fruit added succesfully";
       }
    }
    catch (Exception $e){
      error_log($e->getMessage());
      $error_text = "Adding fruit failed";
    }
  }
  else if ($action == "deleteFruit"){
    try {
     $p_id = $purifier->sanitizeHtml($_POST['id']);
     if (is_numeric($p_id)){
       $fruitSaleDAO->deleteSalesFromFruit($p_id);
       $result = $fruitDAO->deleteFruit($p_id);
       $status_text = "Fruit deleted";
     }
    }
    catch (Exception $e){
      $error_text = "Deleting fruit failed";
    }
  }
  else if ($action == "updateFruit"){
    try {
       $p_fruit_name = $purifier->sanitizeHtml($_POST['name']);
       $p_fruit_diameter = $purifier->sanitizeHtml($_POST['diameter']);
       $p_fruit_description = $purifier->sanitizeHtml($_POST['description']);
       $p_id = $purifier->sanitizeHtml($_POST['id']);
       $fruit_ok=Fruit::checkFruit($p_fruit_name, $p_fruit_diameter, $p_fruit_description, $p_id);
      
       if(!$fruit_ok){
         $error_text="Check input fields";
       }
       else if (is_numeric($p_id)){
          $fruit = $fruitDAO->getFruitById($p_id);
          if ($fruit==null){
             $error_text = "Fruit not found";
          }
          else {
            $fruit->name=$p_fruit_name;
            $fruit->diameter=$p_fruit_diameter;
            $fruit->description=$p_fruit_description;
            $result = $fruitDAO->updateFruit($fruit);
            $status_text = "Fruit updated";
          }
       }
    }
    catch (Exception $e){
      error_log($e->getMessage());
      $error_text = "Failed to update the fruit";
    }
  }
   
}

?>
<!DOCTYPE html>
<html lang="en">
<?php print_head() ?>
<body>
<div class="container">
<?php
  print_status_message($status_text, "ok");
  print_status_message($error_text, "error");

  echo $navigation;
  echo $new_fruit_button = $fruitsComponents->getNewFruitButton(); 

?>

 <h1 class="display-3">Fruits</h1>

<?php 

$fruits = $fruitDAO->getFruits();
$fruitsComponents->printFruitsComponent($fruits);

?>     
</div>

</body>
</html>