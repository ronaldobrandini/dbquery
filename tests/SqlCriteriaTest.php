<?php

use DBQuery\SqlCriteria;
use DBQuery\SqlExpression;
use DBQuery\SqlFilter;
use DBQuery\SqlSelect;

class SqlCriteriaTest extends \PHPUnit_Framework_TestCase
{
    public function testAndExpression()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add(new SqlFilter('id', SqlExpression::_EQUAL_, 1));
        $sqlCriteria->add(new SqlFilter('active', SqlExpression::_EQUAL_, 1));

        $expectedResult         = '(id = 1 AND active = 1)';
        $result = $sqlCriteria->dump();

        $this->assertEquals($expectedResult, $result);
    }

    public function testOrExpression()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add(new SqlFilter('id', SqlExpression::_EQUAL_, 1));
        $sqlCriteria->add(new SqlFilter('active', SqlExpression::_EQUAL_, 1), SqlExpression::_OR_);

        $expectedResult         = '(id = 1 OR active = 1)';
        $result = $sqlCriteria->dump();

        $this->assertEquals($expectedResult, $result);
    }

    public function testMultipleExpression()
    {
        $sqlCriteria1 = new SqlCriteria();
        $sqlCriteria1->add(new SqlFilter('id', SqlExpression::_EQUAL_, 1));
        $sqlCriteria1->add(new SqlFilter('active', SqlExpression::_EQUAL_, 1));

        $sqlCriteria2 = new SqlCriteria();
        $sqlCriteria2->add(new SqlFilter('date', SqlExpression::_EQUAL_, '2015-01-01'));
        $sqlCriteria2->add(new SqlFilter('dateCreate', SqlExpression::_EQUAL_, '2015-01-01'));

        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add($sqlCriteria1);
        $sqlCriteria->add($sqlCriteria2, SqlExpression::_OR_);

        $expectedResult = '((id = 1 AND active = 1) OR (date = \'2015-01-01\' AND dateCreate = \'2015-01-01\'))';
        $result = $sqlCriteria->dump();

        $this->assertEquals($expectedResult, $result);
    }

    public function testPropertyLimit()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_LIMIT, 1);

        $this->assertEquals(1, $sqlCriteria->getProperty(SqlSelect::SQL_LIMIT));
    }

    public function testPropertyLimitSet0()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_LIMIT, 0);

        $this->assertEquals(0, $sqlCriteria->getProperty(SqlSelect::SQL_LIMIT));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPropertyLimitSetNULL()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_LIMIT, null);

        $this->assertEquals(null, $sqlCriteria->getProperty(SqlSelect::SQL_LIMIT));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPropertyLimitSetEmpty()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_LIMIT, '');

        $this->assertEquals(null, $sqlCriteria->getProperty(SqlSelect::SQL_LIMIT));
    }

    public function testPropertyOffset()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_OFFSET, 1);

        $this->assertEquals(1, $sqlCriteria->getProperty(SqlSelect::SQL_OFFSET));
    }

    public function testPropertyOffsetSet0()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_OFFSET, 0);

        $this->assertEquals(0, $sqlCriteria->getProperty(SqlSelect::SQL_OFFSET));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPropertyOffsetSetNULL()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_OFFSET, null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPropertyOffsetSetEmpty()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_OFFSET, '');
    }

    public function testPropertyOrderby()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, 1);

        $this->assertEquals(1, $sqlCriteria->getProperty(SqlSelect::SQL_ORDERBY));
    }

    public function testPropertyOrderbySet0()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, 0);

        $this->assertEquals(0, $sqlCriteria->getProperty(SqlSelect::SQL_ORDERBY));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPropertyOrderbySetNULL()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, null);
    }

    public function testPropertyOrderbySetDesc()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, 1, SqlExpression::_DESC_);

        $this->assertEquals('1 DESC ', $sqlCriteria->getProperty(SqlSelect::SQL_ORDERBY));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPropertyOrderbySetEmpty()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, '');
    }
}
