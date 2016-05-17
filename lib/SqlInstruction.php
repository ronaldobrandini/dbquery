<?php

namespace DBQuery;

use \DBQuery\SqlCriteria;
use Helper\DataHelper;

abstract class SqlInstruction {
    /**
     *  Armazena A string da consulta.
     * Ex: 'Select * from table where conditions '
     * @var (string) 
     */
    protected $sql;
    /**
     *
     * @var DBQuery\Criteria 
     */
    protected $criteria;
    /**
     *
     * @var string 
     */
    protected $entity;

    protected $columnValues;
     
    /**
     * Set the table/Entity to manipulate
     * @param string $entity
     */
    final public function setEntity($entity, $alias = null){
        if($alias){
            $entity = "{$entity} {$alias}";
        }
        $this->entity = $entity;
    }
    /**
     * Get the table/entity to manipulate
     * @return string
     */
    final public function getEntity(){
        return $this->entity;
    }
    /**
     * Set the criteria of query
     * @param DBQuery\SqlCriteria $sqlCriteria
     */
    public function setCriteria(SqlCriteria $sqlCriteria){
        $this->criteria = $sqlCriteria;
    }
    
    public function setRowData($column, $value, $stringForces = true){
        if(!preg_match('/^([[:alnum:]]|_)+$/', $column)){
            throw new \InvalidArgumentException('Column must be setted');
        }
        $this->columnValues[$column] = DataHelper::transform($value, $stringForces);
    }
    
    /**
     * Return the formated string to execute
     */
    abstract function getInstruction();
}
