<?php
namespace sys;
class Autoload {
    private static $instance = null;
    
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new \sys\Autoload();
        }
        return self::$instance;
    }
    
    public function load($classname){
        $classname = ltrim($classname, '\\');
        $filename  = '';
        $namespace = '';
        if($lastnspos = strripos($classname, '\\')){
            
            $namespace = substr($classname, 0, $lastnspos);
            
            $classname = substr($classname, $lastnspos + 1);
            $filename  = str_replace('\\', '/', $namespace) . '/';
        }
        $filename .= str_replace('_', '/', $classname) . '.class.php';
        
        if(file_exists($filename)){
            include_once($filename);
        }else if(file_exists('../' . $filename)){
            include_once('../' . $filename);
        }
    }
}

