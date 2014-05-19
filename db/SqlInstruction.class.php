<?php
namespace db;
abstract class SqlInstruction {
    /**
     *  Armazena A string da consulta.
     * Ex: 'Select * from table where conditions '
     * @var (string) 
     */
    protected $sql;
    protected $criteria;
    protected $entity;


    final public function setEntity($entity){
        $this->entity = $entity;
    }
    
    final public function getEntity(){
        return $this->entity;
    }
    
    public function setCriteria(SqlCriteria $criteria){
        $this->criteria = $criteria;
    }
    
    abstract function getInstruction();
}
