<?php
namespace lib;
class SqlDelete extends SqlInstruction{
    
    public function setRowData($column, $value, $stringForces = true)
    {
        throw new \BadMethodCallException("Cannot call setRowData from " . __CLASS__);
    }
    
    public function getInstruction(){
        $this->sql = "DELETE FROM {$this->entity}";
        if ($this->criteria){
            $expression = $this->criteria->dump();
            if ($expression){
                $this->sql .= ' WHERE ' . $expression;
            }
        }
        return $this->sql;
    }
}
