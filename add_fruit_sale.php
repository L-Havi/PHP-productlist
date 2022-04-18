<?php
require_once('./components/FruitSaleComponents.php');
require_once ('views/header.php');
require_once('utils/SanitizationService.php');

my_error_logging_principles();

  $fruitSaleComponents = new FruitSaleComponents();
  $purifier=new SanitizationService();
  if (isset($_POST["fruitid"]))
  {
    $fruitid=$_POST["fruitid"];
    $fruit_sale_form = $fruitSaleComponents->getFruitSaleForm($fruitid); 
  }
  else {
      return "<html>The sale form cannot be displayed
      because the fruit id field has not been passed
      form.</html>";
  }
 
?>
<!DOCTYPE html>
<html lang="en">
<?php print_head() ?>
<body>  
<div>
 <?php
        $navigation=getNavigation();
        echo $navigation
        
 ?>
</div>
<div class="container">    
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Add sale to a fruit</h1>
        <?php
        
        echo $fruit_sale_form
        
        ?>
    </div>
</div>  
</div>  
</body></html>