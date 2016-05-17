<?php

use DBQuery\SqlUpdate;
use DBQuery\SqlCriteria;
use DBQuery\SqlFilter;
use DBQuery\SqlExpression;

/**
 * Description of SqlUpdateTest
 *
 * @author desenvolvimento
 */
class SqlUpdateTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $sqlString = 'UPDATE user SET name = \'Ronaldo\'';
        
        $sqlUpdate = new SqlUpdate();
        $sqlUpdate->setEntity('user');
        $sqlUpdate->setRowData('name', 'Ronaldo');
        

        // Assert
        $this->assertEquals($sqlString, $sqlUpdate->getInstruction());
    }
    
    public function testBasicCriteria()
    {
        $sqlString = 'UPDATE user SET name = \'Ronaldo\' WHERE (id = 2)';
        
        $sqlUpdate = new SqlUpdate();
        $sqlUpdate->setEntity('user');
        $sqlUpdate->setRowData('name', 'Ronaldo');
        
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add(new SqlFilter('id', SqlExpression::_EQUAL_, 2));
        
        $sqlUpdate->setCriteria($sqlCriteria);

        // Assert
        $this->assertEquals($sqlString, $sqlUpdate->getInstruction());
    }
}
