<?php

require_once('utils/DBUtils.php');
require_once('model/Fruit.php');
require_once ('views/header.php');
require_once('factories/FruitFactory.php');

my_error_logging_principles();

class FruitDAO {

    
    function __construct() {
        #print "FRUITDAO constructor\n";
        $dbutils=new DBUtils();
        $this->fruitFactory = new FruitFactory();
        $this->dbconnection=$dbutils->connectToDatabase();
    }

    public $dbconnection;
    public $fruitFactory;



function addFruit($fruit){
    try { 
        $sql = 'INSERT INTO FRUITS (name, diameter, description) VALUES(:name, :diameter, :description)';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->bindParam('name', $fruit->name, PDO::PARAM_STR, 30);
        $sth->bindParam('diameter', $fruit->diameter, PDO::PARAM_INT);
        $sth->bindParam('description', $fruit->description, PDO::PARAM_STR, 200);
        
        $result = $sth->execute();
        return $result;
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when adding a fruit!"));
    }
}

function updateFruit($fruit){
    try { 
        ##echo print_r($fruit);
        $sql = 'UPDATE FRUITS SET name= :name, diameter= :diameter, description= :description WHERE id= :id';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->bindParam('id', $fruit->id, PDO::PARAM_INT);
        $sth->bindParam('name', $fruit->name, PDO::PARAM_STR, 30);
        $sth->bindParam('diameter', $fruit->diameter, PDO::PARAM_INT);
        $sth->bindParam('description', $fruit->description, PDO::PARAM_STR, 200);
        $result = $sth->execute();
        return $result;
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when updating a fruit!"));
    }
}

function deleteFruit($id){
    try { 
        $sql = 'DELETE FROM FRUITS  
        WHERE id = :id';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when deleting a fruit!"));
    }
}

function getFruits(){
    try {
        $sql = 'SELECT * FROM FRUITS';  
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        $fruit_rows = $sth->fetchAll();
        $fruits = [];
        foreach ($fruit_rows as $fruit_row) {
          //echo print_r($fruit_row);
          array_push($fruits, $this->fruitFactory->createFruitFromArray($fruit_row));
        }
        return $fruits;
    }
    catch (PDOException $exception) {
        error_log($exception->getMessage());
        throw (new Exception("Error when getting fruits!"));
    }
}




function getFruitById($id){
    try { 
        $sql = 'SELECT * FROM FRUITS  
        WHERE id = :id';
        $sth = $this->dbconnection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
        $fruit_row = $sth->fetch();
        if ($fruit_row==null){
            //echo "fruit was null";
            return null;
        }
        else {
            ##echo print_r($fruit_row);
            return $this->fruitFactory->createfruitFromArray($fruit_row);
        }
    }
    catch (PDOException $e){
        error_log($e->getMessage());
        throw (new Exception("Error when getting fruit by id!"));
    }
}

function createFruitsTable(){
    try {
         $dbutils=new DBUtils();
         $db=$dbutils->connectToDatabase();
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "CREATE TABLE FRUITS (
             id INTEGER PRIMARY KEY AUTOINCREMENT,
             name VARCHAR(200) NOT NULL,
             diameter integer,
             description TEXT);";
        $db->exec($sql);
        
    }
    catch (Exception $exception){
       error_log($exception->getMessage());
       throw (new Exception('Creating database failed. '.$exception->getMessage()));
    }
}
}
?>