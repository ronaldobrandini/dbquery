<?php

use core\data\dbquery\SqlCriteria;
use core\data\dbquery\SqlFilter;

$criteria = new SqlCriteria();
$criteria->add(new SqlFilter('id', '=', 1));
$criteria->add(new SqlFilter('dataNascimento', '=', '1986-08-20'));

echo $criteria->dump();

