<?php

namespace core\lib;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tools
 *
 * @author ronaldo.silva
 */
abstract class Tools{

    public static function indent($json){
        $result = '';
        $pos = 0;
        $strLen = strlen($json);
        $indentStr = "\t";
        $newLine = "\n";

        for($i = 0; $i < $strLen; $i++){
// Grab the next character in the string.
            $char = $json[$i];

// Are we inside a quoted string?
            if($char == '"'){
// search for the end of the string (keeping in mind of the escape sequences)
                if(!preg_match('`"(\\\\\\\\|\\\\"|.)*?"`s', $json, $m, null, $i))
                    return $json;

// add extracted string to the result and move ahead
                $result .= $m[0];
                $i += strLen($m[0]) - 1;
                continue;
            }
            else if($char == '}' || $char == ']'){
                $result .= $newLine;
                $pos --;
                $result .= str_repeat($indentStr, $pos);
            }

// Add the character to the result string.
            $result .= $char;

// If the last character was the beginning of an element,
// output a new line and indent the next line.
            if($char == ',' || $char == '{' || $char == '['){
                $result .= $newLine;
                if($char == '{' || $char == '['){
                    $pos ++;
                }

                $result .= str_repeat($indentStr, $pos);
            }
        }

        return $result;
    }

    public static function safePostVars(){
        if(!isset($_POST) || !is_array($_POST)){
            $_POST = array();
        }else{
            $_POST = array_map(array(
                '\core\lib\Tools',
                'htmlentitiesUTF8'), $_POST);
        }
    }

    public static function htmlentitiesUTF8($string, $type = ENT_QUOTES){
        if(is_array($string)){
            return array_map(array(
                '\core\lib\Tools',
                'htmlentitiesUTF8'), $string);
        }
        return htmlentities((string) $string, $type, 'utf-8');
    }

    /**
     * Retorna o valor do post/get passado no parametro.
     *
     * @param string $key Chave do post/get que deseja recuperar.
     * @param mixed $default_value Valor padrão caso retorne NULL.
     * @return mixed Valor da chave passado em $key ou NULL caso não exista.
     */
    public static function getValue($key, $default_value = false){
        if(!isset($key) || empty($key) || !is_string($key)){
            return NULL;
        }
        $ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default_value));

        if(is_string($ret) === true){
            $ret = urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret)));
        }
        return !is_string($ret) ? null : trim(stripslashes($ret));
    }

    public static function getFile($key){
        if(!isset($key) || empty($key) || !is_string($key) || isset($_FILE[$key])){
            return false;
        }
        return $_FILES[$key];
    }

    public static function moveFile($origin, $destination){
        $extencion = strtolower(end(explode('.', $origin['name'])));
        $name = preg_replace('/[^A-Za-z0-9\-]/', '', Tools::passEncrypt(trim(Tools::getValue(time() . $origin['name']))));
        $fullDestination = 'file/' . $name . '.' . $extencion;
        if(is_dir($destination)){
            if(move_uploaded_file($origin['tmp_name'], $destination . $name . '.' . $extencion)){
                return $fullDestination;
            }
            return false;
        }
        return false;
    }

    public static function getHttpHost($http = false, $entities = false, $ignore_port = false){
        $host = (isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST']);
        if($ignore_port && $pos = strpos($host, ':')){
            $host = substr($host, 0, $pos);
        }
        if($entities){
            $host = htmlspecialchars($host, ENT_COMPAT, 'UTF-8');
        }
        if($http){
            $host = (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://') . $host;
        }
        return $host;
    }

    public static function getDomain($http = false, $entities = false){
        if(!$domain = ShopUrl::getMainShopDomain()){
            $domain = Tools::getHttpHost();
        }
        if($entities){
            $domain = htmlspecialchars($domain, ENT_COMPAT, 'UTF-8');
        }
        if($http){
            $domain = 'http://' . $domain;
        }
        return $domain;
    }

    public static function strtoupper($str){
        if(is_array($str)){
            return false;
        }
        if(function_exists('mb_strtoupper')){
            return mb_strtoupper($str, 'utf-8');
        }
        return strtoupper($str);
    }

    public static function strtolower($str){
        if(is_array($str)){
            return false;
        }
        if(function_exists('mb_strtolower')){
            return mb_strtolower($str, 'utf-8');
        }
        return strtolower($str);
    }

    public static function strlen($str, $encoding = 'UTF-8'){
        if(is_array($str)){
            return false;
        }
        $str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
        if(function_exists('mb_strlen')){
            return mb_strlen($str, $encoding);
        }
        return strlen($str);
    }

    public static function substr($str, $start, $length = false, $encoding = 'utf-8'){
        if(is_array($str)){
            return false;
        }
        if(function_exists('mb_substr')){
            return mb_substr($str, (int) $start, ($length === false ? Tools::strlen($str) : (int) $length), $encoding);
        }
        return substr($str, $start, ($length === false ? Tools::strlen($str) : (int) $length));
    }

    public static function ucwords($str){
        if(function_exists('mb_convert_case')){
            return mb_convert_case($str, MB_CASE_TITLE);
        }
        return ucwords(strtolower($str));
    }

    public static function ucfirst($str){
        return Tools::strtoupper(Tools::substr($str, 0, 1)) . Tools::substr($str, 1);
    }

    /**
     * Converte uma string separadas por underscore para camel case.
     * (e.g. first-name -> firstName)
     *
     * @param string $str String com hífen para conversão.
     * @return string String convertida.
     */
    public static function toCamelCase($str, $catapitaliseFirstChar = false){
        $str = Tools::strtolower($str);
        if($catapitaliseFirstChar){
            $str = Tools::ucfirst($str);
        }
        return preg_replace_callback('/_+([a-z])/', create_function('$c', 'return strtoupper($c[1]);'), $str);
    }

    /**
     * Converte uma string camel case para separada com hífen
     * (e.g. firstName -> first-name)
     *
     * @param string $str String em camel case para conversão.
     * @return string String separada por hífen.
     */
    public static function toggleCamelCase($str, $isCamel){
        if($isCamel){
            $str = preg_replace('/(?<=\\w)(?=[A-Z])/', "-$1", $str);
            //$str = Tools::strtolower($str);
            return Tools::strtolower($str);
        }else{
            $str = Tools::ucfirst(Tools::strtolower($str));
            return preg_replace_callback('/-+([a-z])/', create_function('$c', 'return strtoupper($c[1]);'), $str);
        }
    }

    /**
     * Verifica se o submit foi postado
     *
     * @param string $submit nome do submit
     * @return bool <b>true</b> caso foi submitado e <b>false</b> caso contrario
     */
    public static function isSubmit($submit){
        return (
                isset($_POST[$submit]) || isset($_POST[$submit . '_x']) || isset($_POST[$submit . '_y']) || isset($_GET[$submit]) || isset($_GET[$submit . '_x']) || isset($_GET[$submit . '_y'])
                );
    }

    public static function str_replace_once($needle, $replace, $haystack){
        $pos = strpos($haystack, $needle);
        if($pos === false)
            return $haystack;
        return substr_replace($haystack, $replace, $pos, strlen($needle));
    }

    public static function str2url($str){
        $str = trim($str);
        if(function_exists('mb_strtolower')){
            $str = mb_strtolower($str, 'utf-8');
        }

        $str = preg_replace('/[\s\'\:\/\[\]-]+/', ' ', $str);
        $str = str_replace(array(
            ' ',
            '/'), '-', $str);

        if(!function_exists('mb_strtolower')){
            $str = strtolower($str);
        }
        return $str;
    }

    /**
     * Redireciona o usuário para a url passam em $url.
     *
     * @param string $url Url de redirecionamento
     * @param string $baseUri Base URI (optional)
     * @param Link $link [Opcional] Obj link para montar o endereço
     * @param string|array $headers Uma lista de Headers para ser passado
     * @return void
     */
    public static function redirect($url, $baseUri = _BASE_URI, Link $link = null, $headers = null){
        if(!$link){
            //$link = \core\Context::getInstance()->link;
        }
        if(strpos($url, 'http://') === false && strpos($url, 'https://') === false && $link){
            if(strpos($url, $baseUri) === 0){
                $url = substr($url, strlen($baseUri));
            }
            if(strpos($url, 'index.php?controller=') !== false && strpos($url, 'index.php/') == 0){
                $url = substr($url, strlen('index.php?controller='));
                if(Configuration::get('PS_REWRITING_SETTINGS')){
                    $url = Tools::strReplaceFirst('&', '?', $url);
                }
            }

            $explode = explode('?', $url);
            // don't use ssl if url is home page
            // used when logout for example
            $use_ssl = !empty($url);
            $url = $link->getPageLink($explode[0], $use_ssl);
            if(isset($explode[1])){
                $url .= '?' . $explode[1];
            }
        }

        // Send additional headers
        if($headers){
            if(!is_array($headers)){
                $headers = array(
                    $headers);
            }

            foreach($headers as $header){
                header($header);
            }
        }

        header('Location: ' . $url);
        exit;
    }

    public static function displayMessage($msgs, $type){
        \core\Context::getInstance()->smarty->assign('msgs', $msgs);
        \core\Context::getInstance()->smarty->assign('errorType', $type);
    }

    public static function getAdminToken($string){
        return !empty($string) ? Tools::passEncrypt($string) : false;
    }

    public static function getAdminTokenLite($tab, Context $context = null){
        if(!$context)
            $context = Context::getInstance();
        return Tools::getAdminToken($tab . (int) Tab::getIdFromClassName($tab) . (int) $context->employee->id);
    }

    public static function passEncrypt($str){
        $salt = 'Cf1f11ePArKlBJomM0F6aJ';
        $cost = '08';

        return crypt($str, '$2a$' . $cost . '$' . $salt . '$');
    }

    public static function encrypt($text, $keySize = 16){
        $aes = new AES(AES::keygen($keySize));
        return base64_encode($aes->encrypt($text));
    }

    public static function decrypt($decodeText, $keySize = 16){
        $aes = new AES(AES::keygen($keySize));
        return $aes->decrypt(base64_decode($decodeText));
    }

    public static function encode($name, $value){
        switch(gettype($value)){
            case 'boolean':
                $aux = '{' . $name . ':';
                $aux .= $value ? 'true' : 'false';
                return $aux .= '}';
            case 'NULL':
                return '{' . $name . ':' . 'null' . '}';
            case 'integer':
                return '{' . $name . ':' .(int) $value . '}';

            case 'double':
            case 'float':
                return '{' . $name . ':' . (float) $value . '}';

            case 'string':
                // STRINGS ARE EXPECTED TO BE IN ASCII OR UTF-8 FORMAT
                return '{' . $name . ':' . '"' . $value . '"' . '}';

            case 'array':
                break;
        }
    }

    public static function jsonEncode($datas){
        $string = '';
        foreach($datas as $name => $value){
            $string .= self::encode($name, $value);
        }
        
        return str_replace('}{', '},{', $string);
    }

    public static function getIpAddress(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            return $_SERVER['HTTP_CLIENT_IP'];
        }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public static function convert($bytes){
        $unit = array("B", "KB", "MB", "GB");
        $exp = floor(log($bytes, 1024)) | 0;
        return round(ceil($bytes / (pow(1024, $exp))), 2) . ' ' . $unit[$exp];
    }

    public static function uuid(){
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                // 16 bits for "time_mid"
                mt_rand(0, 0xffff),
                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand(0, 0x0fff) | 0x4000,
                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand(0, 0x3fff) | 0x8000,
                // 48 bits for "node"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
    
    public static function gerarToken(){
        $numeros = '123456789'; 
	$resultado = ''; 
	$c = strlen($numeros)-1; 
	 
	for($x=0;$x<=5;$x++) {	
		$aux3 = rand(0,$c); 
		$str3 = substr($numeros,$aux3,1);
		$resultado .= $str3;
		$resultado = trim($resultado);
	}

	return $valorgerado = $resultado; 
    }

}
