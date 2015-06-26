<?php

$criteria1 = new \core\data\dbquery\SqlCriteria();
$criteria1->add(new \core\data\dbquery\SqlFilter('para', '=', 'Ronaldo'));

$criteria2 = new \core\data\dbquery\SqlCriteria();
$criteria2->add(new \core\data\dbquery\SqlFilter('de', '=', 'Rita'));

$criteria3 = new \core\data\dbquery\SqlCriteria();
$criteria3->add($criteria1);
$criteria3->add($criteria2, \core\data\dbquery\SqlExpression::OR_OPERATOR);

$criteria4 = new \core\data\dbquery\SqlCriteria();
$criteria4->add(new core\data\dbquery\SqlFilter('data', '=', '2012-03-03'));

$criteria = new \core\data\dbquery\SqlCriteria();
$criteria->add($criteria3);
$criteria->add($criteria4);
$criteria->setProperty('order', 'data');

echo $criteria->dump();