<?php
namespace db;
use PDO;
class SqlRepository{
    private $class = NULL;
    
    public function __construct($class = NULL){
        if($class){
            $this->class = $class;
        }
    }
    
    public function create(SqlInsert $sqlInsert){
        if($conn = SqlTransaction::get()){
            $result = $conn->exec($sqlInsert->getInstruction());
        }
    }
    
    public function read(SqlSelect $sqlSelect){
        if(!$conn = SqlTransaction::get()){
            SqlTransaction::open('beta');
            $conn = SqlTransaction::get();
        }
        $result = $conn->query($sqlSelect->getInstruction());

        if($result){
            return ($this->class) ? $result->fetchAll(PDO::FETCH_CLASS, '\models\\' . $this->class) : $result->fetchObject();
        }else{
            return false;
        }
        
    }
    
    public function update(SqlUpdate $sqlUpdate){
        if($conn = SqlTransaction::get()){
            $result = $conn->exec($sqlUpdate->getInstruction());
        }
    }
    
    public function delete(SqlDelete $sqlDelete){
        if($conn = SqlTransaction::get()){
            $result = $conn->exec($sqlDelete->getInstruction());
        }
    }
}
