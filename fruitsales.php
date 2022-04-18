<?php
require_once('./dao/FruitSaleDAO.php');
require_once('./dao/FruitDAO.php');
require_once('./model/FruitSale.php');
require_once('./components/FruitSaleComponents.php');
require_once('factories/FruitSaleFactory.php');
require_once('factories/FruitFactory.php');
require_once('utils/SanitizationService.php');
require_once ('views/header.php');

my_error_logging_principles();

$fruitSaleDAO = new FruitSaleDAO();
$fruitDAO = new FruitDAO();
$fruitSaleFactory = new FruitSaleFactory();
$fruitFactory = new FruitFactory();
$fruitSaleComponents = new FruitSaleComponents();
$purifier=new SanitizationService();

if (isset($_POST["fruitid"])){
  $fruitid = $purifier->sanitizeHtml($_POST["fruitid"]);
  $fruit = $fruitDAO->getFruitById($fruitid);

  if ($fruit!=null){
    $fruitName=$fruit->name;
  }
  else {
   echo ("<html><body>Error: Fruit not found</body></html>");
   return;
}
}
else {
   echo ("<html><body>Error: Fruit id missing</body></html>");
   return;
}

$status_text = "";
$error_text = "";


if (isset($_POST["action"])){
   $action = $_POST["action"]; 

   if ($action == "addNewFruitSale"){
    try {
      $p_price = $purifier->sanitizeHtml($_POST['price']);
      $p_saledate = $purifier->sanitizeHtml($_POST['saledate']);
      $p_fruit_id = $purifier->sanitizeHtml($_POST['fruitid']);

      $fruitsale_ok = FruitSale::checkFruitSale($p_price, $p_saledate, $p_fruit_id);

      if (!$fruitsale_ok){
        $error_text = "Check input fields";
      }
      else {
        $fruitSale = $fruitSaleFactory->createFruitSale($p_price, $p_saledate, $p_fruit_id);
        $result = $fruitSaleDAO->addFruitSale($fruitSale);
      }
     }
    catch (Exception $e){
      $error_text="Adding sale failed";
    }
  }
  else if ($action == "deleteFruitSale"){
    try {
      $p_id = $purifier->sanitizeHtml($_POST['id']);

      if (is_numeric($p_id)){
        $result = $fruitSaleDAO->deleteFruitSale($p_id);
      }
    }
    catch (Exception $e){
      $error_text = "Deleting sale failed";
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
  
  $navigation=getNavigation();
   
  echo $navigation;
  echo $fruitSaleComponents->printNewFruitSaleButton($fruitid);

?>


 <h1 class="display-5"><?php echo $fruitName ?> sales</h1>

<?php 

  $fruitSales = $fruitSaleDAO->getFruitSales($fruitid);
  $fruitSaleComponents->printFruitSalesComponent($fruitSales);
  
?>     
</div>

</body>
</html>