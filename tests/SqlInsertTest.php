<?php

use DBQuery\SqlInsert;
use DBQuery\SqlCriteria;

class SqlInsertTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $str = 'INSERT INTO user (id, name) VALUES (1, \'Ronaldo\')';
        
        $sqlInsert = new SqlInsert();
        $sqlInsert->setEntity('user');
        $sqlInsert->setRowData('id', 1);
        $sqlInsert->setRowData('name', 'Ronaldo');
        
        $this->assertEquals($str, $sqlInsert->getInstruction());
    }
    
    public function testCallCriteria()
    {   
        try{
            $sqlInsert = new SqlInsert();
            $sqlInsert->setEntity('user');
            $sqlInsert->setRowData('ç-', 1);
            
            $sqlInsert->setCriteria(new SqlCriteria());
            
        } catch (Exception $e){
            $this->assertTrue(true);
            return;
        }
        $this->fail('A Exception waiting not throws.');
    }
    
    
}
