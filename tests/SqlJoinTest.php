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
}
