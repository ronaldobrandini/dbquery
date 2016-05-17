<?php

namespace lib;

use lib\SqlInstruction;
use lib\SqlExpression;

class SqlJoin extends SqlInstruction
{

    const _INNER_ = 'INNER';
    const _LEFT_ = 'LEFT';
    const _RIGHT_ = 'RIGHT';
    const _OUTER_ = 'OUTER';
    const _FULL_ = 'FULL';
    
    private $type;
    private $filters = array();
    private $expressions;
    private $operators;

    public function __construct($type, $entity, $alias = null)
    {
        $this->type = $type;
        if($alias){
            $entity = "{$entity} {$alias}";
        }
        $this->entity = $entity;
    }

    public function add(SqlExpression $expression, $operador = SqlExpression::_ON_)
    {
        $this->expressions[] = $expression;
        $this->operators[] = $operador;
    }

    public function getInstruction()
    {
        if(is_array($this->expressions)){
            if(count($this->expressions) > 0){
                $result = '';
                foreach($this->expressions as $i => $expression){
                    $operator = $this->operators[$i];
                    $result .= $operator . $expression->dump();
                }
                $result = trim($result);
                return "({$this->type} JOIN {$this->entity} {$result})";
            }
        }
        return "{$this->type} JOIN {$this->entity} " . implode(' ', $this->filters);
    }

}
