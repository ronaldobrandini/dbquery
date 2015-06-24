<?php

namespace controller;

/**
 * Description of PageNotFound
 *
 * @author ronaldo.silva
 */
class PageNotFound extends Controller{
    public function initContent(){
        if($this->api){
            $this->content['statusServidor'] = array(
                'id' => 1,
                'ativo' => 404,
                'mensagem' => 'Endereço invalido'
            );
        }else{
            $this->tpl->addFile('content', _ROOT_DIR_ . 'view/404.tpl');
        }
    }
    
}
