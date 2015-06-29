<?php

namespace controller;

/**
 * Description of Demo
 *
 * @author ronaldo.silva
 */
class Demo extends Controller {

    private $xml;
    private $types = array(
        'insert',
        'delete',
        'select',
        'join',
        'update',
        'criteria'
    );
    private $example = array();

    private function getDemo() {
        $this->xml = simplexml_load_file(_ROOT_DIR_ . 'example.xml');
        foreach ($this->types as $type) {
            $this->tpl->title = ucwords($type);
            if (isset($this->xml->$type->example)) {
                foreach ($this->xml->$type->example as $example) {
                    $this->example[$type][] = $example;
                    $this->tpl->link = _BASE_URI . 'demo/' . $type . '/' . strval($example->file);
                    $this->tpl->name = strval($example->name);



                    $this->tpl->block('block_example');
                }
            }
            $this->tpl->block('block_example_type');
        }
    }

    public function initContent() {
        $this->tpl->addFile('content', _ROOT_DIR_ . 'view/demo.tpl');

        $this->getDemo();
        if (\core\Dispatcher::getInstance()->getParam('type') && \core\Dispatcher::getInstance()->getParam('demo')) {
            foreach ($this->example[\core\Dispatcher::getInstance()->getParam('type')] as $example) {

                if ($example->file == \core\Dispatcher::getInstance()->getParam('demo')) {
                    $nomeArquivo = _ROOT_DIR_
                            . \core\constante\Base::_DIR_EXEMPLO
                            . \core\Dispatcher::getInstance()->getParam('type') . '/'
                            . $example->file . '.php';

                    if (file_exists($nomeArquivo)) {
                        ob_start();
                        include $nomeArquivo;
                        $this->tpl->result = ob_get_contents();
                        ob_end_clean();

                        ob_start();
                        show_source($nomeArquivo);
                        $code = ob_get_contents();
                        ob_end_clean();
                        
                        $this->tpl->code = trim($code);
                    }
                    $this->tpl->titleExample = strval($example->title);
                    foreach ($example->text as $text) {
                        $this->tpl->text = strval($example->text);
                        $this->tpl->block('block_text');
                    }
                }
            }
        }
    }

    protected function setMedia() {
        parent::setMedia();
        $this->addJs('highlight.pack.js');
        $this->addCSS('github.css');
        $this->jsString[] = 'hljs.initHighlightingOnLoad();';
    }

}
