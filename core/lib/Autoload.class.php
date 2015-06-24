<?php
/**
 * 
 * Public Class Autoload
 * 
 * Classe responsavel pelo carregamento das classes
 * 
 * @package core.lib
 * @access public
 * @author Ronaldo Silva <ronaldo.silva@xsystems.com.br>
 * @version 1.0 08/05/2014
 */
class Autoload{
    /**
     *
     * @var Autoload Instancia atual de Autoload 
     */
    protected static $instance;
    /**
     * Cria ou recupera a instancia da classe
     * @return Autoload Instancia de Autoload
     */
    public static function getInstance(){
        if(!Autoload::$instance){
            Autoload::$instance = new Autoload();
        }
        return Autoload::$instance;
    }
    /**
     * Carrega o arquivo necessário para instanciar uma classe.
     * 
     * @param string $className Nome da classe a ser carregada
     */
    public function load($className){
        if(!class_exists($className, FALSE)){
            
        }
        $explode =  ltrim($className, '\\');
        $fileName = explode('\\', $explode);

        if(file_exists( _ROOT_DIR_ . _DS . implode(_DS, $fileName) . '.class.php')){
            require_once( _ROOT_DIR_ . _DS . implode(_DS, $fileName) . '.class.php');
        }else{
            
        }
    }
}
