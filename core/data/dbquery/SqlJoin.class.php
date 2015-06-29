<?php
namespace core\data\dbquery;
class SqlJoin extends SqlInstruction{
    private $type;
    private $filters = array();
    
    public function __construct($type, $entity){
        $this->type = $type;
        $this->entity = $entity;
    }
    
    
    public function addFilter($variable, $operator, $value, $filter = SqlExpression::ON_OPERATOR){
                
        $this->filters[] = " {$filter} {$variable} {$operator} {$value} ";
    }


    public function getInstruction(){
        return " {$this->type} JOIN {$this->entity} " . implode(' ', $this->filters);
    }
}
