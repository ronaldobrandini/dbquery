<?php

use lib\SqlSelect;
use lib\SqlCriteria;
use lib\SqlFilter;
use lib\SqlExpression;

/**
 * Description of SqlCriteriaTest
 *
 * @author desenvolvimento
 */
class SqlCriteriaTest extends \PHPUnit_Framework_TestCase
{
    public function testAndExpression()
    {
        $str = '(id = 1 AND active = 1)';
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add(new SqlFilter('id', SqlExpression::_EQUAL_, 1));
        $sqlCriteria->add(new SqlFilter('active', SqlExpression::_EQUAL_, 1));
        // Assert
        $this->assertEquals($str, $sqlCriteria->dump());
    }
    
    public function testOrExpression()
    {
        $str = '(id = 1 OR active = 1)';
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add(new SqlFilter('id', SqlExpression::_EQUAL_, 1));
        $sqlCriteria->add(new SqlFilter('active', SqlExpression::_EQUAL_, 1), SqlExpression::_OR_);
        // Assert
        $this->assertEquals($str, $sqlCriteria->dump());
    }
    
    public function testMultipleExpression()
    {
        $str = '((id = 1 AND active = 1) OR (date = \'2015-01-01\' AND dateCreate = \'2015-01-01\'))';
        
        $sqlCriteria1 = new SqlCriteria();
        $sqlCriteria1->add(new SqlFilter('id', SqlExpression::_EQUAL_, 1));
        $sqlCriteria1->add(new SqlFilter('active', SqlExpression::_EQUAL_, 1));
        
        $sqlCriteria2 = new SqlCriteria();
        $sqlCriteria2->add(new SqlFilter('date', SqlExpression::_EQUAL_, '2015-01-01'));
        $sqlCriteria2->add(new SqlFilter('dateCreate', SqlExpression::_EQUAL_, '2015-01-01'));
        
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->add($sqlCriteria1);
        $sqlCriteria->add($sqlCriteria2, SqlExpression::_OR_);
        
        // Assert
        $this->assertEquals($str, $sqlCriteria->dump());    
    }
    
    public function testPropertyLimit()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_LIMIT, 1);
        // Assert
        $this->assertEquals(1, $sqlCriteria->getProperty(SqlSelect::SQL_LIMIT));
    }
    
    public function testPropertyLimitSet0()
    {   
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_LIMIT, 0);
        // Assert
        $this->assertEquals(0, $sqlCriteria->getProperty(SqlSelect::SQL_LIMIT));
    }
    
    public function testPropertyLimitSetNULL()
    {   
        try{
            $sqlCriteria = new SqlCriteria();
            $sqlCriteria->setProperty(SqlSelect::SQL_LIMIT, null);
            // Assert
            $this->assertEquals(null, $sqlCriteria->getProperty(SqlSelect::SQL_LIMIT));
        } catch (InvalidArgumentException $e){
            $this->assertTrue(true);
            return;
        }
        $this->fail('A waiting exception not throws.');
    }
    
    public function testPropertyLimitSetEmpty()
    {   
        try{
            $sqlCriteria = new SqlCriteria();
            $sqlCriteria->setProperty(SqlSelect::SQL_LIMIT, '');
            // Assert
            $this->assertEquals(null, $sqlCriteria->getProperty(SqlSelect::SQL_LIMIT));
        } catch (InvalidArgumentException $e){
            $this->assertTrue(true);
            return;
        }
        $this->fail('A waiting exception not throws.');
    }
    
    public function testPropertyOffset()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_OFFSET, 1);
        // Assert
        $this->assertEquals(1, $sqlCriteria->getProperty(SqlSelect::SQL_OFFSET));
    }
    
    public function testPropertyOffsetSet0()
    {   
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_OFFSET, 0);
        // Assert
        $this->assertEquals(0, $sqlCriteria->getProperty(SqlSelect::SQL_OFFSET));
    }
    
    public function testPropertyOffsetSetNULL()
    {   
        try{
            $sqlCriteria = new SqlCriteria();
            $sqlCriteria->setProperty(SqlSelect::SQL_OFFSET, null);
        } catch (InvalidArgumentException $e){
            $this->assertTrue(true);
            return;
        }
        // Assert
        $this->fail('A waiting exception not throws.');
    }
    
    public function testPropertyOffsetSetEmpty()
    {   
        try{
            $sqlCriteria = new SqlCriteria();
            $sqlCriteria->setProperty(SqlSelect::SQL_OFFSET, '');
        } catch (InvalidArgumentException $e){
            $this->assertTrue(true);
            return;
        }
        // Assert
        $this->fail('A waiting exception not throws.');
    }
    
    public function testPropertyOrderby()
    {
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, 1);
        // Assert
        $this->assertEquals(1, $sqlCriteria->getProperty(SqlSelect::SQL_ORDERBY));
    }
    
    public function testPropertyOrderbySet0()
    {   
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, 0);
        // Assert
        $this->assertEquals(0, $sqlCriteria->getProperty(SqlSelect::SQL_ORDERBY));
    }
    
    public function testPropertyOrderbySetNULL()
    {   
        try{
            $sqlCriteria = new SqlCriteria();
            $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, null);
        }  catch (InvalidArgumentException $e){
            $this->assertTrue(true);
            return;
        }
        // Assert
        $this->fail('A waiting exception not throws.');
    }
    
    public function testPropertyOrderbySetDesc()
    {   
        $sqlCriteria = new SqlCriteria();
        $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, 1, SqlExpression::_DESC_);
        // Assert
        $this->assertEquals('1 DESC ', $sqlCriteria->getProperty(SqlSelect::SQL_ORDERBY));
    }
    
    public function testPropertyOrderbySetEmpty()
    {   
        try{
            $sqlCriteria = new SqlCriteria();
            $sqlCriteria->setProperty(SqlSelect::SQL_ORDERBY, '');
        }  catch (InvalidArgumentException $e){
            $this->assertTrue(true);
            return;
        }
        // Assert
        $this->fail('A waiting exception not throws.');
    }
}
