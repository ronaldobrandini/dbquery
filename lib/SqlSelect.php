<?php
namespace DBQuery;
use Exception\DbQueryColumnsNotSet;
use Exception\DbQueryEntityNotSet;

final class SqlSelect extends SqlInstruction{
    
    const SQL_LIMIT = 'limit';
    const SQL_OFFSET = 'offset';
    const SQL_ORDERBY = 'orderby';
    
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
    
    public function setRowData($column, $value, $stringForces = true)
    {
        throw new \BadMethodCallException("Cannot call setRowData from " . __CLASS__);
    }

    
    public function getInstruction() {
        if(!$this->columns){
            throw new DbQueryColumnsNotSet();
        }
        
        if(!$this->entity){
            throw new DbQueryEntityNotSet();
        }
        
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
            
            $order = $this->criteria->getProperty(self::SQL_ORDERBY);
            $limit = $this->criteria->getProperty(self::SQL_LIMIT);
            $offset = $this->criteria->getProperty(self::SQL_OFFSET);
            
            if ($order !== false){
                $this->sql .= SqlExpression::_ORDER_ . $order;
            }
            if ($limit !== false){
                $this->sql .= SqlExpression::_LIMIT_ . $limit;
            }
            if ($offset !== false){
                $this->sql .= SqlExpression::_OFFSET_ . $offset;
            }
        }
        return $this->sql;
    }
}
