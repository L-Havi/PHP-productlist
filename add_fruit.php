<?php

require_once('./components/FruitComponents.php');
require_once ('views/header.php');

my_error_logging_principles();

$fruit_form = FruitComponents::getFruitForm(); 

?>

<!DOCTYPE html>
<html lang="en">
<?php print_head() ?>
<body>  
<div class="container">    
 <?php

        $navigation=getNavigation();

        echo $navigation
        
 ?>

    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Add new</h1>
        <?php
        
        echo $fruit_form
        
        ?>
    </div> 
</div>  
</body></html>