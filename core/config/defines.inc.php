<?php
$currentDir = dirname(__FILE__);

define('_ROOT_DIR_', realpath($currentDir . '/../..') . '/');
define('_DS', DIRECTORY_SEPARATOR);

define('_BASE_URI', '//' .$_SERVER['SERVER_NAME'] .'/dbquery/');
define('_CSS_ROOT_DIR',  'view/css/');
define('_JS_ROOT_DIR',  'view/js/');