<?php

include_once('../../../core/config/cfg.php');

$criteria = new core\data\dbquery\SqlCriteria();
$criteria->add(new \core\data\dbquery\SqlFilter('id', '=', 1));
$criteria->add(new \core\data\dbquery\SqlFilter('dataNascimento', '=', '1986-08-20'));

echo $criteria->dump();

