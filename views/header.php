<?php


function my_error_logging_principles(){
    ini_set('log_error', '1');
    ini_set('error_log', 'libraryapplicationerrors.log');  
}

 function print_head(){
     echo '<head>';
     echo '<meta charset="utf-8">';
     echo '<title>Fruits</title>';
     echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
     echo "<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">";
     echo "<link href=\"https://fonts.googleapis.com/css?family=Lato:300,400,700\" rel=\"stylesheet\" type=\"text/css\">";
     echo "</head>";
 }

 function getNavigation(){
    return "<div>".
    "<a style=\"margin: 19px;\" href=\"allfruitsales.php\" class=\"btn btn-secondary\">".
    "Sales</a>".
    "<a style=\"margin: 19px;\" href=\"index.php\" class=\"btn btn-secondary\">Fruits</a>".
    "</div>";
 }

 function print_status_message($status_text, $type="primary"){
     if ($status_text==null || $status_text==""){
         return;
     }
     $bt_class="alert alert-primary";
     if ($type=="error"){
         $bt_class="alert alert-danger";
     }
     else if ($type=="ok"){
         $bt_class="alert alert-success";
     }
     echo '<div class="'.$bt_class.'" style="margin-top: 5vw">'.$status_text.'</div>';
 }
?>