<?php

use lib\SqlSelect;
use lib\SqlCriteria;
use lib\SqlFilter;
use lib\SqlExpression;

/**
 * Description of SqlSelectTest
 *
 * @author desenvolvimento
 */
class SqlSelectTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicSelect()
    {
        $sqlString = 'SELECT * FROM user';
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');
        

        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getInstruction());
    }
    
    public function testCriteriaSelect()
    {
        $sqlString = 'SELECT * FROM user WHERE (id = 1)';
        
        $criteria = new SqlCriteria();
        $criteria->add(new lib\SqlFilter('id', SqlExpression::_EQUAL_, 1));
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');
        $sqlSelect->setCriteria($criteria);

        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getInstruction());
    }
    
    public function testLimitSelect()
    {
        $sqlString = 'SELECT * FROM user LIMIT 10';
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');
        
        $criteria = new SqlCriteria();
        $criteria->setProperty(SqlSelect::SQL_LIMIT, 10);

        $sqlSelect->setCriteria($criteria);
        
        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getInstruction());
    }
    
    public function testOffsetSelect()
    {
        $number = rand(0, 10);
        $sqlString = 'SELECT * FROM user OFFSET ' . $number;
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');
        
        $criteria = new SqlCriteria();
        $criteria->setProperty(SqlSelect::SQL_OFFSET, $number);

        $sqlSelect->setCriteria($criteria);
        
        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getInstruction());
    }
    
    public function testOrderbySelect()
    {
        $sqlString = 'SELECT * FROM user ORDER BY 0';
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');
        
        $criteria = new SqlCriteria();
        $criteria->setProperty(SqlSelect::SQL_ORDERBY, 0);

        $sqlSelect->setCriteria($criteria);
        
        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getInstruction());
    }
    
    public function testMultipleProperty()
    {
        $sqlString = 'SELECT * FROM user ORDER BY 1 DESC LIMIT 10 OFFSET 10';
        
        $sqlSelect = new SqlSelect();
        $sqlSelect->addColumn('*');
        $sqlSelect->setEntity('user');
        
        $criteria = new SqlCriteria();
        $criteria->setProperty(SqlSelect::SQL_OFFSET, 10);
        $criteria->setProperty(SqlSelect::SQL_ORDERBY, '1 DESC');
        $criteria->setProperty(SqlSelect::SQL_LIMIT, 10);

        $sqlSelect->setCriteria($criteria);
        
        // Assert
        $this->assertEquals($sqlString, $sqlSelect->getInstruction());
    }
}
