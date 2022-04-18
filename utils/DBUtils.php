<?php


class DBUtils {

function connectToDatabase(){
  $myPDO = new PDO('sqlite:bookdatabasefile');
  return $myPDO;
} 



}

?>