<?php

require_once('utils/DBUtils.php');
require_once('model/FruitSale.php');
require_once ('views/header.php');
require_once('factories/FruitSaleFactory.php');

my_error_logging_principles();

class FruitSaleDAO {

    
    function __construct() {
        #print "FRUITSALEDAO constructor\n";
        $dbutil=new DBUtils();
        $this->dbconnection=$dbutil->connectToDatabase();
        $this->fruitSaleFactory = new FruitSaleFactory();
    }

    public $dbconnection;
    public $fruitSaleFactory;



function addFruitSale($fruitsale){
   
    try { 
        $sql = 'INSERT INTO FRUITSALE (price, saledate, fruitid) VALUES(:price, :saledate, :fruitid)';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->bindParam('price', $fruitsale->price, PDO::PARAM_INT);
        $sth->bindParam('saledate', $fruitsale->saledate, PDO::PARAM_STR, 10);
        $sth->bindParam('fruitid', $fruitsale->fruitid, PDO::PARAM_INT);
        
        $result = $sth->execute();
        return $result;
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when adding a fruitsale!"));
    }
}

function updateFruitSale($fruitsale){
    try { 
        $sql = 'UPDATE FRUITSALE SET price= :price, saledate= :saledate, fruitid= :fruitid WHERE id= :id';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->bindValue('id', $fruitsale->id);
        $sth->bindValue('price', $fruitsale->price);
        $sth->bindValue('saledate', $fruitsale->saledate);
        $sth->bindValue('fruitid', $fruitsale->fruitid);
        $result = $sth->execute();
        return $result;
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when updating a fruitsale!"));
    }
}


function deleteFruitSale($id){
    try { 
        $sql = 'DELETE FROM FRUITSALE 
        WHERE id = :id';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when deleting a fruitsale!"));
    }
}

function deleteSalesFromFruit($fruitid){
    try { 
        $sql = 'DELETE FROM FRUITSALE  
        WHERE fruitid = :fruitid';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':fruitid' => $fruitid));
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when deleting sales from a fruit!"));
    }
}


function getFruitSales($fruitid){
    try {
        $sql = 'SELECT * FROM FRUITSALE WHERE FRUITID=:fruitid';  
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':fruitid' => $fruitid));
        $fruit_sale_rows = $sth->fetchAll();
        $fruitsales = [];
        foreach ($fruit_sale_rows as $fruit_sale_row) {
          array_push($fruitsales, $this->fruitSaleFactory->createFruitSaleFromArray($fruit_sale_row));
        }
        return $fruitsales;
    }
    catch (PDOException $exception) {
        error_log($exception->getMessage());
        throw (new Exception("Error when getting fruitsales!"));
    }
}

function getAllFruitSales(){
    try {
        $sql = 'SELECT * FROM FRUITSALE';  
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        $fruit_sale_rows = $sth->fetchAll();
        $fruitsales = [];
        foreach ($fruit_sale_rows as $fruit_sale_row) {
          array_push($fruitsales, $this->fruitSaleFactory->createFruitSaleFromArray($fruit_sale_row));
        }
        return $fruitsales;
    }
    catch (PDOException $exception) {
        error_log($exception->getMessage());
        throw (new Exception("Error when getting fruitsales!"));
    }
}


function getFruitSaleById($id){
    try { 
        $sql = 'SELECT * FROM FRUITSALE  
        WHERE id = :id';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
        $fruit_sale_row = $sth->fetch();
        if ($fruit_sale_row==null){
            echo "fruitsale was null";
            return null;
        }
        else {
            return $this->FruitSaleFactory->createFruitSaleFromArray($fruit_sale_row);
        }
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when getting fruit by id!"));
    }
}

function createFruitSaleTable(){
    try {
         $dbutils=new DBUtils();
         $db=$dbutils->connectToDatabase();
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "CREATE TABLE FRUITSALE (
             id INTEGER PRIMARY KEY AUTOINCREMENT,
             price integer NOT NULL,
             saledate VARCHAR(200) NOT NULL,
             fruitid integer not null,
             FOREIGN KEY (fruitid) REFERENCES FRUITS(id));";
        $db->exec($sql);
        
    }
    catch (Exception $exception){
       throw (new Exception('Creating database failed.'));
    }
}
}
?>