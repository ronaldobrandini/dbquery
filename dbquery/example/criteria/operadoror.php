<?php
$criteria = new core\data\dbquery\SqlCriteria();
$criteria->add(new \core\data\dbquery\SqlFilter('id', '=', 1));
$criteria->add(new \core\data\dbquery\SqlFilter('dataNascimento', '=', '1986-08-20'), \core\data\dbquery\SqlExpression::OR_OPERATOR);

echo $criteria->dump();

