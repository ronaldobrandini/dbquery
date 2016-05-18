<?php

use DBQuery\SqlCriteria;
use DBQuery\SqlExpression;
use DBQuery\SqlSelect;

class SqlSelectTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicSelect()
    {
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');
        $expectedResult = 'SELECT * FROM user';

        $this->assertEquals($expectedResult, $sqlSelect->getInstruction());
    }

    public function testCriteriaSelect()
    {
        $criteria = new SqlCriteria();
        $criteria->add(new DBQuery\SqlFilter('id', SqlExpression::_EQUAL_, 1));

        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');
        $sqlSelect->setCriteria($criteria);

        $expectedResult = 'SELECT * FROM user WHERE (id = 1)';

        $this->assertEquals($expectedResult, $sqlSelect->getInstruction());
    }

    /**
     * @expectedException Exception
     */
    public function testSetRowDataCall()
    {
        $sqlSelect = new SqlSelect();
        $sqlSelect->setEntity('user');
        $sqlSelect->setRowData('ç-', 1);

        $sqlSelect->setCriteria(new SqlCriteria());
    }

    public function testLimitSelect()
    {
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');

        $criteria = new SqlCriteria();
        $criteria->setProperty(SqlSelect::SQL_LIMIT, 10);

        $sqlSelect->setCriteria($criteria);

        $expectedResult = 'SELECT * FROM user LIMIT 10';

        $this->assertEquals($expectedResult, $sqlSelect->getInstruction());
    }

    public function testOffsetSelect()
    {
        $number    = rand(0, 10);
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');

        $criteria = new SqlCriteria();
        $criteria->setProperty(SqlSelect::SQL_OFFSET, $number);

        $sqlSelect->setCriteria($criteria);

        $expectedResult = 'SELECT * FROM user OFFSET ' . $number;

        $this->assertEquals($expectedResult, $sqlSelect->getInstruction());
    }

    public function testOrderbySelect()
    {
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');

        $criteria = new SqlCriteria();
        $criteria->setProperty(SqlSelect::SQL_ORDERBY, 0);

        $sqlSelect->setCriteria($criteria);
        $expectedResult = 'SELECT * FROM user ORDER BY 0';

        $this->assertEquals($expectedResult, $sqlSelect->getInstruction());
    }

    public function testMultipleProperty()
    {
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');

        $criteria = new SqlCriteria();
        $criteria->setProperty(SqlSelect::SQL_OFFSET, 10);
        $criteria->setProperty(SqlSelect::SQL_ORDERBY, '1 DESC');
        $criteria->setProperty(SqlSelect::SQL_LIMIT, 10);

        $sqlSelect->setCriteria($criteria);
        $expectedResult = 'SELECT * FROM user ORDER BY 1 DESC LIMIT 10 OFFSET 10';

        $this->assertEquals($expectedResult, $sqlSelect->getInstruction());
    }
}
