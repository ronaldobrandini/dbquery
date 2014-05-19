<?php
namespace controller;
class Promotor{
    
    public function onLoad($criterias = array(), $joins = array()){
        $dataMapper = new \datamapper\Promotor();
        
        $dataMapper->load($criterias, $joins);
    }
    
    public function onUpdate($conditions){
        if(is_array($conditions)){
            
        }else{
            throw new Exception('Erro');
        }
    }
}
