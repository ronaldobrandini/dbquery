<?php
$select = new \core\data\dbquery\SqlSelect();
$select->setEntity('usuario');
$select->addColumn('*');
echo $select->getInstruction();

