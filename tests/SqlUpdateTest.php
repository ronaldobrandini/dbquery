<?php

use DBQuery\SqlUpdate;
use DBQuery\SqlCriteria;
use DBQuery\SqlFilter;
use DBQuery\SqlExpression;

class SqlUpdateTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $sqlUpdate = new SqlUpdate();
        $sqlUpdate->setEntity('user');
        $sqlUpdate->setRowData('name', 'Ronaldo');

        $expectedResult = 'UPDATE user SET name = \'Ronaldo\'';

        $this->assertEquals($expectedResult, $sqlUpdate->getInstruction());
    }
    
    public function testBasicCriteria()
    {
        $sqlUpdate = new SqlUpdate();
        $sqlUpdate->setEntity('user');
        $sqlUpdate->setRowData('name', 'Ronaldo');
        
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add(new SqlFilter('id', SqlExpression::_EQUAL_, 2));
        
        $sqlUpdate->setCriteria($sqlCriteria);
        $expectedResult = 'UPDATE user SET name = \'Ronaldo\' WHERE (id = 2)';

        $this->assertEquals($expectedResult, $sqlUpdate->getInstruction());
    }
}
