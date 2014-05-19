<?php

namespace datamapper;

class Promotor{
    private $tableName = 'usuario';
    private $alias = 'U';
    private $class = 'Promotor';
    private $fields = array(
        'idUsuario AS id',
        'nome AS name',
        'idPerfilUsuario AS perfil'
    );

    public function save(\models\Promotor $promotor){
        $sql = new \db\SqlInsert();
        $sql->setEntity($this->tableName);
        $sql->setRowData('name', $promotor->getName());

        echo $sql->getInstruction();
    }

    public function load($criteria, $joins = array()){
        $sqlSelect = new \db\SqlSelect();
        $sqlSelect->setEntity($this->tableName . ' ' . $this->alias);
        
        foreach($this->fields as $field){
            $sqlSelect->addColumn($this->alias . '.' . $field);
        }

        if(isset($criteria)){
            $sqlSelect->setCriteria($criteria);
        }

        foreach($joins as $join){
            $sqlSelect->setJoin($join);
        }

        try{
            $repository = new \db\SqlRepository($this->class);
            return $repository->read($sqlSelect);
        }catch(Exception $ex){
            
        }
    }

    public function update(\db\SqlCriteria $criteria, $fields){
        if(!is_array($fields)){
            throw new Exception('AAAeeee');
        }
        $sql = new \db\SqlUpdate();
        $sql->setEntity($this->tableName);

        foreach($fields as $column => $value){
            $sql->setRowData($column, $value);
        }

        if(isset($criteria)){
            $sql->setCriteria($criteria);
        }

        echo $sql->getInstruction();
    }

    public function delete(\db\SqlCriteria $criteria){

        $sql = new \db\SqlDelete();
        $sql->setEntity($this->tableName);

        if(isset($criteria)){
            $sql->setCriteria($criteria);
        }

        echo $sql->getInstruction();
    }

}
