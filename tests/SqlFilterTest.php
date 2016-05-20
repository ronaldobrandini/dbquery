<?php

use DBQuery\SqlFilter;
use DBQuery\SqlExpression;
use DBQuery\SqlSelect;
use DBQuery\SqlBetween;

class SqlFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicEqual()
    {
        $expectedResult = 'id = 1';
        $filter = new SqlFilter('id', SqlExpression::_EQUAL_, 1);

        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicIn()
    {
        $expectedResult = 'id IN 1';
        $filter = new SqlFilter('id', SqlExpression::_IN_, 1);

        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicNotIn()
    {
        $expectedResult = 'id NOT IN 1';
        $filter = new SqlFilter('id', SqlExpression::_NOT_IN_, 1);
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicIs()
    {
        $expectedResult = 'id IS 1';
        $filter = new SqlFilter('id', SqlExpression::_IS_, 1);
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicIsNot()
    {
        $expectedResult = 'id IS NOT 1';
        $filter = new SqlFilter('id', SqlExpression::_IS_NOT_, 1);
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicInt()
    {
        $expectedResult = 'id = 1';
        $filter = new SqlFilter('id', SqlExpression::_EQUAL_, 1);
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicString()
    {
        $expectedResult = 'id = \'string\'';
        $filter = new SqlFilter('id', SqlExpression::_EQUAL_, "string");
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicNull()
    {
        $expectedResult = 'id = null';
        $filter = new SqlFilter('id', SqlExpression::_EQUAL_, null);
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicArray()
    {
        $expectedResult = 'id = (1, 2, 3)';
        $filter = new SqlFilter('id', SqlExpression::_EQUAL_, array(1,2,3));
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicTrue()
    {
        $expectedResult = 'id = true';
        $filter = new SqlFilter('id', SqlExpression::_EQUAL_, true);
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicFalse()
    {
        $expectedResult = 'id = false';
        $filter = new SqlFilter('id', SqlExpression::_EQUAL_, false);
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicSubquery()
    {
        
        $expectedResult = 'id IN (SELECT id FROM user)';
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('id');
        $sqlSelect->setEntity('user');
        
        $filter = new SqlFilter('id', SqlExpression::_IN_, $sqlSelect);
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
    
    public function testBasicBetween()
    {
        $expectedResult = 'date BETWEEN \'2016-01-01\' AND \'2016-01-31\'';
        $filter = new SqlFilter('date', SqlExpression::_BETWEEN_, new SqlBetween('2016-01-01', SqlExpression::_AND_, '2016-01-31'));
        
        $this->assertEquals($expectedResult, $filter->dump());
    }
}
