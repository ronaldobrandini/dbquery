<?php

use DBQuery\SqlBetween;
use DBQuery\SqlExpression;

/**
 * Description of SqlBetweenTest
 *
 * @author desenvolvimento
 */
class SqlBetweenTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $str = '\'2016-01-01\' AND \'2016-01-31\'';
        $sqlBetween = new SqlBetween('2016-01-01', SqlExpression::_AND_, '2016-01-31');
        $this->assertEquals($str, $sqlBetween->dump());
    }
}
