<?php

require_once('./dao/FruitDAO.php');
require_once('./dao/FruitSaleDAO.php');
require_once('./model/Fruit.php');
require_once('./model/FruitSale.php');
require_once('./components/FruitComponents.php');
require_once('factories/FruitFactory.php');
require_once('./components/FruitSaleComponents.php');
require_once('factories/FruitSaleFactory.php');

require_once ('views/header.php');
require_once('utils/SanitizationService.php');

$fruitSaleDAO = new FruitSaleDAO();
$fruitSaleComponents = new FruitSaleComponents();
$purifier = new SanitizationService();
$navigation = getNavigation();

$status_text = "";
$error_text = "";

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

?>

 <h1 class="display-3">Sales</h1>

<?php 

$fruitSales = $fruitSaleDAO->getAllFruitSales();
$fruitSaleComponents->printFruitSalesComponent($fruitSales);

?>     
</div>

</body>
</html>