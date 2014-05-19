<?php
    include_once(dirname(__FILE__).'/define.inc.php');
    include_once(dirname(__FILE__) .'/Autoload.php'); 
    include_once(dirname(__FILE__) .'/ErrorReport.php');
    
    spl_autoload_register(array(sys\Autoload::getInstance(), 'load'));
    
   