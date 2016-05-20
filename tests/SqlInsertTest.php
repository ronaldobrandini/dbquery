<?php

use DBQuery\SqlCriteria;
use DBQuery\SqlInsert;

class SqlInsertTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $sqlInsert = new SqlInsert();
        $sqlInsert->setEntity('user');
        $sqlInsert->setRowData('id', 1);
        $sqlInsert->setRowData('name', 'Ronaldo');

        $expectedResult = 'INSERT INTO user (id, name) VALUES (1, \'Ronaldo\')';

        $this->assertEquals($expectedResult, $sqlInsert->getInstruction());
    }

    /**
     * @expectedException Exception
     */
    public function testCallCriteria()
    {
        $sqlInsert = new SqlInsert();
        $sqlInsert->setEntity('user');
        $sqlInsert->setRowData('ç-', 1);

        $sqlInsert->setCriteria(new SqlCriteria());
    }
}
