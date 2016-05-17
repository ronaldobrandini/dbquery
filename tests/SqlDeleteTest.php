<?php

use DBQuery\SqlDelete;
use DBQuery\SqlCriteria;
use DBQuery\SqlFilter;
use DBQuery\SqlExpression;


class SqlDeleteTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $sqlString = 'DELETE FROM user';
        
        $sqlDelete = new SqlDelete();
        $sqlDelete->setEntity('user');
        

        // Assert
        $this->assertEquals($sqlString, $sqlDelete->getInstruction());
    }
    
    public function testBasicCriteria()
    {
        $sqlString = 'DELETE FROM user WHERE (id = 2)';
        
        $sqlDelete = new SqlDelete();
        $sqlDelete->setEntity('user');
        
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add(new SqlFilter('id', SqlExpression::_EQUAL_, 2));
        
        $sqlDelete->setCriteria($sqlCriteria);

        // Assert
        $this->assertEquals($sqlString, $sqlDelete->getInstruction());
    }
    
    public function testSetRowDataCall()
    {   
        try{
            $sqlDelete = new SqlDelete();
            $sqlDelete->setEntity('user');
            $sqlDelete->setRowData('k', 1);
            
        } catch (BadMethodCallException $e){
            
            $this->assertTrue(true);
            return;
        }
        $this->fail('A BadMethodCallException waiting not throws.');
    }
}
