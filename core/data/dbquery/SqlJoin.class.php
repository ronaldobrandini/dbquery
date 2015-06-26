<?php
namespace core\data\dbquery;
class SqlJoin extends SqlInstruction{
    private $type;
    private $filter = '';
    
    public function __construct($type, $entity){
        $this->type = $type;
        $this->entity = $entity;
    }
    
    
    public function addFilter($variable, $operator, $value, $filter = 'ON'){
                
        $this->filter .= " {$filter} {$variable} {$operator} {$value} ";
    }


    public function getInstruction(){
        return " {$this->type} JOIN {$this->entity} {$this->filter} ";
    }
}
