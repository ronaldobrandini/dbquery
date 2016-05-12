<?php

use core\data\dbquery\SqlCriteria;
use core\data\dbquery\SqlFilter;
use core\data\dbquery\SqlExpression;

$criteria1 = new SqlCriteria();
$criteria1->add(new SqlFilter('para', '=', 'Ronaldo'));

$criteria2 = new SqlCriteria();
$criteria2->add(new SqlFilter('de', '=', 'Rita'));

$criteria3 = new SqlCriteria();
$criteria3->add($criteria1);
$criteria3->add($criteria2, SqlExpression::_OR_);

$criteria4 = new SqlCriteria();
$criteria4->add(new SqlFilter('data', '=', '2012-03-03'));

$criteria = new SqlCriteria();
$criteria->add($criteria3);
$criteria->add($criteria4);
$criteria->setProperty('order', 'data');

echo $criteria->dump();