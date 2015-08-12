<?php

namespace core\lib;

/**
 * 
 * Public Class ErrorReport
 * 
 * 
 * 
 * 
 * @package core.lib.highchart
 * @access public
 * @author Ronaldo Silva <ronaldo.silva@xsystems.com.br>
 * @version 1.0 08/05/2014
 * 
 */
class ErrorReport {

    private static $instance = null;

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new ErrorReport();
        }
        return self::$instance;
    }

    public function javascriptErrorHandler($trace, $message, $params) {
//        try{
//            $message = new \app\lib\Template(ROOT . '/mail/themes/errorJavascript.tpl');
//
//            $message->trace = $trace;
//            $message->message = $message;
//            $message->params = $params;
//
//            $headers  = 'MIME-Version: 1.0' . "\r\n";
//            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//
//            mail('ronaldo.silva@compart.com.br, alexandre.zacarias@compart.com.br', 'COMPLOG Erro', $message->show(), $headers);
//        }catch(\Exception $ex){
//            $this->exceptionHandler($ex);
//        }
    }

    public function exceptionHandler(\Exception $ex) {
        $message = new \core\lib\Template(_VIEW_DIR_ . 'error-mail.tpl');

        $message->cod = $ex->getCode();
        $message->message = $ex->getMessage();
        $message->file = $ex->getFile();
        $message->line = $ex->getLine();
        $message->trace = preg_replace("/\n/", '<br>', $ex->getTraceAsString());
        //var_dump($ex);
        foreach ($ex->getTrace() as $traces) {
            if (is_array($traces)) {
                foreach ($traces['args'] as $key => $arg) {
                    if (is_string($arg)) {
                        $message->query = $arg;
                        $message->block('block_query');
                    }
                }
            }
            //var_dump($traces['args']);
        }

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        echo $message->parse();
        //header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        //echo 'aqui';


        mail('ronaldo.silva@compart.com.br', '[GDMobile] Log Erro', $message->parse(), $headers);


        //Tools::redirect('?controller=error&code=500');
    }

    public function overtimeHandler($time, $memory) {
//        $message = new \app\lib\Template(ROOT . '/mail/themes/overtime.tpl');
//        
//        $message->uri = $_SERVER['REQUEST_URI'];
//        $message->method = $_SERVER['REQUEST_METHOD'];
//        $message->time = $time;
//        $message->memory = $memory;
//        
//        
//        $headers  = 'MIME-Version: 1.0' . "\r\n";
//        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//        
        //mail('ronaldo.silva@compart.com.br, alexandre.zacarias@compart.com.br', 'GDMobile ErroR', $message->show(), $headers);
    }

    public function errorHandler() {
        //$err = error_get_last();
        //mail('ronaldo.silva@compart.com.br', '[GDMobile Error]', implode($err, ','));
    }

    public function shutdown() {
        //ob_end_clean();
        $err = error_get_last();

        if (!isset($err)){
            return;
        }

        $handledErrorTypes = array(
            E_USER_ERROR      => 'USER ERROR',
            E_ERROR           => 'ERROR',
            E_PARSE           => 'PARSE',
            E_CORE_ERROR      => 'CORE_ERROR',
            E_CORE_WARNING    => 'CORE_WARNING',
            E_COMPILE_ERROR   => 'COMPILE_ERROR',
            E_COMPILE_WARNING => 'COMPILE_WARNING'
        );

        // If our last error wasn't fatal then this must be a normal shutdown.  
        if (!isset($handledErrorTypes[$err['type']])){
            return;
        }
        
        
        
        if (!headers_sent()){
            header('HTTP/1.1 500 Internal Server Error');
        }
        //$message = new \app\lib\Template('mail/themes/error.tpl');
        
        mail('ronaldo.silva@compart.com.br', 'GDMobile FatalError', implode($err, ','));
//        
//        
    }

}
