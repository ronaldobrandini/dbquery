<?php
namespace lib;
use Helper\DataHelper;

class SqlInsert extends SqlInstruction{
        
    public function setCriteria(SqlCriteria $criteria){
        throw new \BadMethodCallException("Cannot call setCriteria from " . __CLASS__);
    }
    
    public function getInstruction(){
        
        $columns = implode(', ', array_keys($this->columnValues));
        $values = implode(', ', array_values($this->columnValues));
        
        $this->sql = "INSERT INTO {$this->entity} ({$columns}) VALUES ({$values})";
        
        return $this->sql;
    }
}
