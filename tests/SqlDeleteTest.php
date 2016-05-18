<?php

use DBQuery\SqlCriteria;
use DBQuery\SqlDelete;
use DBQuery\SqlExpression;
use DBQuery\SqlFilter;


class SqlDeleteTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $sqlDelete = new SqlDelete();
        $sqlDelete->setEntity('user');
        $expectedResult = 'DELETE FROM user';

        $this->assertEquals($expectedResult, $sqlDelete->getInstruction());
    }

    public function testBasicCriteria()
    {
        $sqlDelete = new SqlDelete();
        $sqlDelete->setEntity('user');

        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add(new SqlFilter('id', SqlExpression::_EQUAL_, 2));

        $sqlDelete->setCriteria($sqlCriteria);

        $expectedResult = 'DELETE FROM user WHERE (id = 2)';

        $this->assertEquals($expectedResult, $sqlDelete->getInstruction());
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testSetRowDataCall()
    {
        $sqlDelete = new SqlDelete();
        $sqlDelete->setEntity('user');
        $sqlDelete->setRowData('k', 1);
    }
}
