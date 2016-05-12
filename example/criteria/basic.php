<?php

use core\data\dbquery\SqlCriteria;
use core\data\dbquery\SqlFilter;

$criteria = new SqlCriteria();
$criteria->add(new SqlFilter('id', '=', 1));
echo $criteria->dump();

