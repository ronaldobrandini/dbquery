<?php

namespace controller;

/**
 * Description of Demo
 *
 * @author ronaldo.silva
 */
class Demo extends Controller{

    private $xml;
    private $types = array(
        'insert',
        'delete',
        'select',
        'update',
        'criteria'
    );
    private $example = array();

    private function getDemo(){
        $this->xml = simplexml_load_file(_ROOT_DIR_ . 'example.xml');
        foreach($this->types as $type){
            $this->tpl->title = ucwords($type);
            if(isset($this->xml->$type->example)){
                foreach($this->xml->$type->example as $example){
                    $this->example[$type][] = $example;
                    $this->tpl->link = _BASE_URI . 'demo/' . $type . '/' . strval($example->file);
                    $this->tpl->name = strval($example->name);



                    $this->tpl->block('block_example');
                }
            }
            $this->tpl->block('block_example_type');
        }
    }

    public function initContent(){
        $this->tpl->addFile('content', _ROOT_DIR_ . 'view/demo.tpl');

        $this->getDemo();
        if(\core\Dispatcher::getInstance()->getParam('type') && \core\Dispatcher::getInstance()->getParam('demo')){
            foreach($this->example[\core\Dispatcher::getInstance()->getParam('type')] as $example){
                if($example->file == \core\Dispatcher::getInstance()->getParam('demo')){
                    $this->tpl->titleExample = strval($example->title);
                    $this->tpl->code = strval($example->code);
                    $this->tpl->result = strval($example->result);
                    foreach($example->text as $text){
                        $this->tpl->text = strval($example->text);
                        $this->tpl->block('block_text');
                    }
                }
            }
        }

        //$this->tpl->example = \core\Dispatcher::getInstance()->getParam('demo');
    }
    
    protected function setMedia(){
        parent::setMedia();
        $this->addJs('highlight.pack.js');
        $this->addCSS('zenburn.css');
        $this->jsString[] = 'hljs.initHighlightingOnLoad();';
    }

}
