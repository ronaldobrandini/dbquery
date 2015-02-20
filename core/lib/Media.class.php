<?php
namespace core\lib;
class Media{

    /**
     * addCSS retorna o caminho do stylesheet.
     *
     * @param mixed $cssUri
     * @param string $cssMediaType
     * @return array
     */
    public function getCSSPath($cssURI, $cssMediaType = 'all'){
        if(empty($cssURI))
            return false;
        // remove PS_BASE_URI on _PS_ROOT_DIR_ for the following
        $urlData = parse_url($cssURI);
        $fileUri = _CSS_ROOT_DIR . Tools::str_replace_once(_BASE_URI, _DS, $urlData['path']);
        // check if css files exists
        //var_dump(Autoload::load('Context', 'sys')->controller);
        

        return array($fileUri => $cssMediaType);
    }

    /**
     * addJS return javascript path
     *
     * @param mixed $jsUri
     * @return string
     */
    public function getJSPath($jsUri){
        if(is_array($jsUri) || $jsUri === null || empty($jsUri))
            return false;
        $urlData = parse_url($jsUri);
        if(!array_key_exists('host', $urlData)){
            $fileUri = _JS_ROOT_DIR . Tools::str_replace_once(_BASE_URI, _DS, $urlData['path']);  // remove PS_BASE_URI on _PS_ROOT_DIR_ for the following
        }else{
            $fileUri = $jsUri;
        // check if js files exists
        }
        
        return $fileUri;
    }

}
