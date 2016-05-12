<?php

use lib\SqlFilter;
use lib\SqlExpression;

/**
 * Description of SqlFilterTest
 *
 * @author desenvolvimento
 */
class SqlFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicEqual()
    {
        $str = 'id = 1';
        $filtro = new SqlFilter('id', SqlExpression::_EQUAL_, 1);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicIn()
    {
        $str = 'id IN 1';
        $filtro = new SqlFilter('id', SqlExpression::_IN_, 1);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicNotIn()
    {
        $str = 'id NOT IN 1';
        $filtro = new SqlFilter('id', SqlExpression::_NOT_IN_, 1);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicIs()
    {
        $str = 'id IS 1';
        $filtro = new SqlFilter('id', SqlExpression::_IS_, 1);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicIsNot()
    {
        $str = 'id IS NOT 1';
        $filtro = new SqlFilter('id', SqlExpression::_IS_NOT_, 1);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicInt()
    {
        $str = 'id = 1';
        $filtro = new SqlFilter('id', SqlExpression::_EQUAL_, 1);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicString()
    {
        $str = 'id = "string"';
        $filtro = new SqlFilter('id', SqlExpression::_EQUAL_, "string");
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicNull()
    {
        $str = 'id = null';
        $filtro = new SqlFilter('id', SqlExpression::_EQUAL_, null);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicArray()
    {
        $str = 'id = (1, 2, 3)';
        $filtro = new SqlFilter('id', SqlExpression::_EQUAL_, array(1,2,3));
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicTrue()
    {
        $str = 'id = true';
        $filtro = new SqlFilter('id', SqlExpression::_EQUAL_, true);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
    
    public function testBasicFalse()
    {
        $str = 'id = false';
        $filtro = new SqlFilter('id', SqlExpression::_EQUAL_, false);
        // Assert
        $this->assertEquals($str, $filtro->dump());
    }
}
