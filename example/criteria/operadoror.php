<?php

use core\data\dbquery\SqlCriteria;
use core\data\dbquery\SqlFilter;
use core\data\dbquery\SqlExpression;

$criteria = new SqlCriteria();
$criteria->add(new SqlFilter('id', '=', 1));
$criteria->add(new SqlFilter('dataNascimento', '=', '1986-08-20'), SqlExpression::_OR_);

echo $criteria->dump();

