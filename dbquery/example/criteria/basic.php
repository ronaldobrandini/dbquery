<?php

include_once('../../../core/config/cfg.php');

$criteria = new core\data\dbquery\SqlCriteria();
$criteria->add(new \core\data\dbquery\SqlFilter('id', '=', 1));

echo $criteria->dump();

