<?php

include_once('defines.inc.php');
include_once(_ROOT_DIR_ . 'core/lib/Autoload.class.php');

spl_autoload_register(array(Autoload::getInstance(), 'load'));