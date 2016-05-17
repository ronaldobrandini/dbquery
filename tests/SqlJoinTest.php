<?php

use lib\SqlJoin;
use lib\SqlFilter;
use lib\SqlExpression;

/**
 * Description of SqlJoinTest
 *
 * @author desenvolvimento
 */
class SqlJoinTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicInner()
    {
        $sqlString = '(INNER JOIN table b ON a.column = b.column)';
        $sqlJoin = new SqlJoin(SqlJoin::_INNER_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        
        
        $this->assertEquals($sqlString, $sqlJoin->getInstruction());
    }
    
    public function testMultipleFilterInner()
    {
        $sqlString = '(INNER JOIN table b ON a.column = b.column AND a.column = 1)';
        $sqlJoin = new SqlJoin(SqlJoin::_INNER_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 1), SqlExpression::_AND_);
        
        
        $this->assertEquals($sqlString, $sqlJoin->getInstruction());
    }
    
    public function testBasicLeft()
    {
        $sqlString = '(LEFT JOIN table b ON a.column = b.column)';
        $sqlJoin = new SqlJoin(SqlJoin::_LEFT_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        
        
        $this->assertEquals($sqlString, $sqlJoin->getInstruction());
    }
    
    public function testBasicFull()
    {
        $sqlString = '(FULL JOIN table b ON a.column = b.column)';
        $sqlJoin = new SqlJoin(SqlJoin::_FULL_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        
        
        $this->assertEquals($sqlString, $sqlJoin->getInstruction());
    }
    
    public function testBasicOutter()
    {
        $sqlString = '(OUTER JOIN table b ON a.column = b.column)';
        $sqlJoin = new SqlJoin(SqlJoin::_OUTER_, 'table', 'b');
        $sqlJoin->add(new SqlFilter('a.column', SqlExpression::_EQUAL_, 'b.column', false));
        
        
        $this->assertEquals($sqlString, $sqlJoin->getInstruction());
    }
}
