<?php

namespace controller;

abstract class Controller{

    protected $tpl;
    private $cssFiles = array();
    private $jsFiles = array();
    protected $jsString = array();
    protected $displayHeader = true;
    protected $displayFooter = true;
    protected $api = false;
    protected $ajax = false;
    protected $content = array();
    protected $display;
    protected $msgs = array();
    protected $session;

    public function __construct(){
        if(defined('_API_')){
            $this->displayHeader = false;
            $this->displayFooter = false;
            $this->api = true;


            switch(\core\Dispatcher::getInstance()->requestMethod){
                case 'GET' :
                    $this->display = 'list';
                    break;
                case 'POST' :
                    $this->display = 'add';
                    break;
            }
        }else{
            $this->display = \core\lib\Tools::getValue('display', 'list');

//            $this->session = new \core\lib\Session();
//            if($this->auth && !$this->session->checkUserSession()){
//
//                \core\lib\Tools::redirect('?controller=autenticacao&redirect=' . $this->authRedirection);
//            }

            if(\core\lib\Tools::getValue('logout')){
                $this->session->destroy();
                \core\lib\Tools::redirect('./');
            }
        }

        if($this->isXmlHttpRequest()){
            $this->ajax = true;
        }


        $this->tpl = new \core\lib\Template(_ROOT_DIR_ . 'view/layout.tpl');
        if(!$this->api){
            $this->setMedia();
        }

        if(\core\lib\Tools::isSubmit('submit')){
            $this->submit = true;
            switch(\core\lib\Tools::getValue('acao')){
                case 'add' :
                    $this->salvar();
                    break;
                case 'edit' :
                    $this->editar();
                    break;
                case 'active' :
                    $this->ativo();
                    break;
                case 'login' :

                    $this->login();
                    break;
            }
        }
    }

    public abstract function initContent();

    public static function getController($controllerName){
        return new $controllerName();
    }

    private function initHeader(){
        $this->tpl->addFile('header', _ROOT_DIR_ . 'view/header.tpl');
    }

    /**
     * Adiciona um novo Arquivo CSS na página
     * @see \core\lib\Media::getCSSPath()
     * 
     * @param mixed $cssUri Caminho para o arquivo ou uma lista no formato array(array( uri => mediaType ), ...))
     * @param string $mediaType MediaType do arquivo (all, print, screen) Padrão all
     * @return bool 
     */
    public function addCSS($cssUri, $cssMediaType = 'all'){
        $media = new \core\lib\Media();
        if(is_array($cssUri)){
            foreach($cssUri as $cssFile => $media){
                if(is_string($cssFile) && strlen($cssFile) > 1){
                    $cssPath = $media->getCSSPath($cssFile, $media);
                    if($cssPath && !in_array($cssPath, $this->cssFiles)){
                        $this->cssFiles = array_merge($this->cssFiles, $cssPath);
                    }
                }else{
                    $cssPath = $media->getCSSPath($media, $cssMediaType);
                    if($cssPath && !in_array($cssPath, $this->cssFiles)){
                        $this->cssFiles = array_merge($this->cssFiles, $cssPath);
                    }
                }
            }
        }else if(is_string($cssUri) && strlen($cssUri) > 1){
            $cssPath = $media->getCSSPath($cssUri, $cssMediaType);
            if($cssPath){
                $this->cssFiles = array_merge($this->cssFiles, $cssPath);
            }
        }
    }

    /**
     * Add um novo arquivo js na página
     * @see \core\lib\Media::getJSPath()
     * @param mixed $jsUri
     * @return void
     */
    public function addJs($jsUri){
        $media = new \core\lib\Media();
        if(is_array($jsUri)){
            foreach($jsUri as $jsFile){
                $jsPath = $media->getJSPath($jsFile);
                if($jsPath && !in_array($jsPath, $this->jsFiles)){
                    $this->jsFiles[] = $jsPath;
                }
            }
        }else{
            $jsPath = $media->getJSPath($jsUri);
            if($jsPath){
                $this->jsFiles[] = $jsPath;
            }
        }
    }

    private function show(){
        echo $this->tpl->parse();
    }

    private function displayMessage(){
        if($this->msgs){
            $this->tpl->addFile('msgFile', _ROOT_DIR_ . 'view/msg.tpl');
            if($this->api || $this->ajax){
                //mostra mensagem no formato json para mobile ou ajax
            }else{
                foreach($this->msgs as $i => $msgs){
                    $this->tpl->errorType = $i;
                    foreach($msgs as $msg){
                        $this->tpl->msg = $msg;
                        $this->tpl->block('block_msgs');
                    }
                    $this->tpl->block('block_msg_' . $i);
                }
            }
        }
    }

    public function run(){
        if($this->api || $this->ajax){
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html;"' . "\r\n";

            //mail('ronaldo.silva@compart.com.br, guilherme.ambrozio@compart.com.br', 'GDMobile: SMART ' . \core\Dispatcher::getInstance()->getController(), \core\lib\Tools::getValue('dados'), $headers);
        }
        if($this->displayHeader){
            $this->initHeader();
        }
        $this->initContent();
        if($this->displayFooter){
            
        }
        if($this->cssFiles){
            foreach($this->cssFiles as $css => $media){
                $this->tpl->css = _BASE_URI . $css;
                $this->tpl->media = $media;
                $this->tpl->block('block_css');
            }
        }

        if($this->jsFiles){
            foreach($this->jsFiles as $js){
                $this->tpl->js = _BASE_URI . $js;
                $this->tpl->block('block_js');
            }
        }

        if($this->jsString){
            foreach($this->jsString as $jsString){
                $this->tpl->jsString = $jsString;
                $this->tpl->block('block_js_string');
            }
        }




        $this->displayMessage();
        $this->show();
    }

    protected function setMedia(){
        $this->addCSS('bootstrap.min.css');
        $this->addCSS('style.css');
        $this->addJs('jquery.min.js');
        $this->addJs('bootstrap.min.js');
    }

    public function isXmlHttpRequest(){
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

}
