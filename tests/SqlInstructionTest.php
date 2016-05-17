<?php

use DBQuery\SqlSelect;
use DBQuery\SqlInsert;

class SqlInstructionTest extends \PHPUnit_Framework_TestCase
{
    public function testSetEntityWithoutAlias()
    {
        $sqlString = 'user';
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->setEntity('user');
        

        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getEntity());
    }
    
    public function testSetEntityWithAlias()
    {
        $sqlString = 'user u';
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->setEntity('user', 'u');
        

        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getEntity());
    }
    
    public function testSetRowDataInvalidColumn()
    {
        $sqlString = 'user u';
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->setEntity('user', 'u');
        

        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getEntity());
    }
    
    public function testInvalidColumnName()
    {   
        try{
            $sqlInsert = new SqlInsert();
            $sqlInsert->setEntity('user');
            $sqlInsert->setRowData('ç-', 1);
            
        } catch (InvalidArgumentException $e){
            $this->assertTrue(true);
            return;
        }
        $this->fail('A InvalidArgumentException waiting not throws.');
    }
}
