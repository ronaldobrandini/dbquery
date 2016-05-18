<?php

use DBQuery\SqlInsert;
use DBQuery\SqlSelect;

class SqlInstructionTest extends \PHPUnit_Framework_TestCase
{
    public function testSetEntityWithoutAlias()
    {
        $sqlSelect = new SqlSelect();
        $sqlSelect->setEntity('user');
        $expectedResults = 'user';

        $this->assertEquals($expectedResults, $sqlSelect->getEntity());
    }

    public function testSetEntityWithAlias()
    {
        $sqlSelect = new SqlSelect();
        $sqlSelect->setEntity('user', 'u');
        $expectedResults = 'user u';

        $this->assertEquals($expectedResults, $sqlSelect->getEntity());
    }

    public function testSetRowDataInvalidColumn()
    {
        $sqlSelect = new SqlSelect();
        $sqlSelect->setEntity('user', 'u');
        $expectedResult = 'user u';

        $this->assertEquals($expectedResult, $sqlSelect->getEntity());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidColumnName()
    {
        $sqlInsert = new SqlInsert();
        $sqlInsert->setEntity('user');
        $sqlInsert->setRowData('ç-', 1);
    }
}
