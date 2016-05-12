<?php
$currentDir = dirname(__FILE__);
define('_ROOT_DIR_', realpath($currentDir . '/..'));

function autoload($className)
{
    if (!class_exists($className, FALSE)) {
        
    }
    $explode = ltrim($className, '\\');
    $fileName = explode('\\', $explode);

    if (file_exists(_ROOT_DIR_ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $fileName) . '.php')) {
        require_once( _ROOT_DIR_ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $fileName) . '.php');
    } else {
        echo _ROOT_DIR_ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $fileName) . '.php';
    }
}

spl_autoload_register('autoload');