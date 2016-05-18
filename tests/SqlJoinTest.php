<?php

use DBQuery\SqlJoin;
use DBQuery\SqlFilter;
use DBQuery\SqlExpression;

class SqlJoinTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicInner()
    {
        $sqlJoin = new SqlJoin(SqlJoin::_INNER_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        $expectedResult = '(INNER JOIN table b ON a.column = b.column)';

        $this->assertEquals($expectedResult, $sqlJoin->getInstruction());
    }
    
    public function testMultipleFilterInner()
    {
        $sqlJoin = new SqlJoin(SqlJoin::_INNER_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 1), SqlExpression::_AND_);
        $expectedResult = '(INNER JOIN table b ON a.column = b.column AND a.column = 1)';

        $this->assertEquals($expectedResult, $sqlJoin->getInstruction());
    }
    
    public function testBasicLeft()
    {
        $sqlJoin = new SqlJoin(SqlJoin::_LEFT_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        $expectedResult = '(LEFT JOIN table b ON a.column = b.column)';

        $this->assertEquals($expectedResult, $sqlJoin->getInstruction());
    }
    
    public function testBasicFull()
    {
        $sqlJoin = new SqlJoin(SqlJoin::_FULL_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        $expectedResult = '(FULL JOIN table b ON a.column = b.column)';

        $this->assertEquals($expectedResult, $sqlJoin->getInstruction());
    }
    
    public function testBasicOutter()
    {
        $sqlJoin = new SqlJoin(SqlJoin::_OUTER_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        $expectedResult = '(OUTER JOIN table b ON a.column = b.column)';
        
        $this->assertEquals($expectedResult, $sqlJoin->getInstruction());
    }
}
