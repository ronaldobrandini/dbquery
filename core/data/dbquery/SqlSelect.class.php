<?php
namespace core\data\dbquery;
final class SqlSelect extends SqlInstruction{
    
    private $columns = array();
    private $joins = array();
    
    
    public function addColumn($column){
        if(is_array($column)){
            $this->columns = $column;
        }else{
            $this->columns[] = $column;
        }
    }
    
    public function setJoin(SqlJoin $sqlJoin){
        $this->joins[] = $sqlJoin;
    }
    
    public function getInstruction() {
        $this->sql = 'SELECT ';
        
        $this->sql .= implode(', ', $this->columns);
        
        $this->sql .= ' FROM ' . $this->entity;
                
        if($this->joins){
            foreach($this->joins as $join){
                $this->sql .= $join->getInstruction();
            }
        }
        
        if ($this->criteria){
            $expression = $this->criteria->dump();
            if ($expression){
                $this->sql .= ' WHERE ' . $expression;
            }
            
            $order = $this->criteria->getProperty('order');
            $limit = $this->criteria->getProperty('limit');
            $offset= $this->criteria->getProperty('offset');
            
            if ($order){
                $this->sql .= ' ORDER BY ' . $order;
            }
            if ($limit){
                $this->sql .= ' LIMIT ' . $limit;
            }
            if ($offset){
                $this->sql .= ' OFFSET ' . $offset;
            }
        }
        return $this->sql;
    }
}
