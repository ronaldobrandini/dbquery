<?php

namespace controller;

/**
 * Description of Doc
 *
 * @author ronaldo
 */
class Doc extends Controller{
    private function montarTelaDocGeral(){
        $this->tpl->addFile('content', _ROOT_DIR_ . 'view/doc.tpl');
        if(file_exists(_ROOT_DIR_ . 'view/' . \core\Dispatcher::getInstance()->getParam('nome') . '.tpl')){
            $this->tpl->addFile('texto', _ROOT_DIR_ . 'view/' . \core\Dispatcher::getInstance()->getParam('nome') . '.tpl');
        }else{
            $this->tpl->addFile('texto', _ROOT_DIR_ . 'view/geral.tpl');
        }
    }
    public function initContent() {
        switch (\core\lib\Tools::getValue('type')){
            default :
                $this->montarTelaDocGeral();
            break;
        }
    }

}
