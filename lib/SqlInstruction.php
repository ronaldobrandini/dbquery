<?php

namespace lib;

use \lib\SqlCriteria;

abstract class SqlInstruction {
    /**
     *  Armazena A string da consulta.
     * Ex: 'Select * from table where conditions '
     * @var (string) 
     */
    protected $sql;
    /**
     *
     * @var \lib\dbquery\Criteria 
     */
    protected $criteria;
    /**
     *
     * @var string 
     */
    protected $entity;

    /**
     * Define o nome da tabela que sera trabalhado
     * @param string $entity
     */
    final public function setEntity($entity, $alias = null){
        if($alias){
            $entity = $entity . ' ' . $alias;
        }
        $this->entity = $entity;
    }
    /**
     * Retorna o nome da tabela que sera trabalhado
     * @return string
     */
    final public function getEntity(){
        return $this->entity;
    }
    /**
     * Define um critério de seleção
     * @param \lib\dbquery\SqlCriteria $criteria
     */
    public function setCriteria(SqlCriteria $criteria){
        $this->criteria = $criteria;
    }
    /**
     * Metodo que retorna a instrução gerada
     */
    abstract function getInstruction();
}
