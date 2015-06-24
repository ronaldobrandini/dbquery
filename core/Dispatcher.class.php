<?php

namespace core;

/**
 * Description of Dispatcher
 *
 * @author ronaldo.silva
 */
class Dispatcher{

    protected static $instance;
    private $controller;
    public $requestUri;
    private $defaultController = 'index';
    private $controllerNotFound = 'page-not-found';
    private $routes = array();
    private $params = array();
    private $paramNames = array();
    private $paramNamesPath = array();
    public $requestMethod = null;

    public function __construct(){
        $this->setRequestUri();
        $this->loadRoutes();
    }

    /**
     *
     * @return Dispatcher A instancia atual de Dispatcher
     */
    public static function getInstance(){
        if(!Dispatcher::$instance){
            Dispatcher::$instance = new Dispatcher();
        }
        return self::$instance;
    }

    /**
     * Captura o controller passado pela url
     *
     * @return void
     */
    public function dispatch(){
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->getController();

        if(!$this->controller){
            $this->controller = $this->defaultController;
        }

        if(!class_exists('\controller\\' . \core\lib\Tools::toggleCamelCase($this->controller, false))){
            $this->controller = $this->controllerNotFound;
        }
        $controllerName = \core\lib\Tools::toggleCamelCase($this->controller, false);
        $controller = \controller\Controller::getController('\controller\\' . $controllerName);
        $this->controller = '';

        $controller->run();
    }

    public function matches($pattern, $conditions = array()){
        $patternAsRegex = preg_replace_callback(
                '#:([\w]+)\+?#', array(
            $this,
            'matchesCallback'), str_replace(')', ')?', (string) $pattern)
        );
        if(substr($pattern, -1) === '/'){
            $patternAsRegex .= '?';
        }
        if(!preg_match('#^' . $patternAsRegex . '$#', $this->requestUri, $paramValues)){
            return false;
        }

        foreach($this->paramNames as $name){
            if(isset($paramValues[$name])){
                if(isset($this->paramNamesPath[$name])){
                    $this->params[$name] = explode('/', urldecode($paramValues[$name]));
                }else{
                    $this->params[$name] = urldecode($paramValues[$name]);
                }
            }
        }

        return true;
    }

    private function matchesCallback($m){
        $this->paramNames[] = $m[1];
        if(isset($this->conditions[$m[1]])){
            return '(?P<' . $m[1] . '>' . $this->conditions[$m[1]] . ')';
        }

        foreach($this->routes as $route){
            if(isset($route['conditions'][$m[1]])){
                return '(?P<' . $m[1] . '>' . $route['conditions'][$m[1]] . ')';
            }
        }

        if(substr($m[0], -1) === '+'){
            $this->paramNamesPath[$m[1]] = 1;

            return '(?P<' . $m[1] . '>.+)';
        }

        return '(?P<' . $m[1] . '>[^/]+)';
    }

    public function getController(){

        if($this->controller){
            $_GET['controller'] = $this->controller;
            return $this->controller;
        }

        $controller = \core\lib\Tools::getValue('controller');

        if(!$this->requestUri){
            return $this->controllerNotFound;
        }

        if(!preg_match('/\.(gif|jpe?g|png|css|js|ico)$/i', $this->requestUri)){

            if(isset($this->routes)){

                foreach($this->routes as $route){

                    if($this->matches($route['rule'])){

                        $controller = isset($route['controller']) ? $route['controller'] : $_GET['controller'];
                    }
                }
            }
        }

        $this->controller = $controller;

        $_GET['controller'] = $this->controller;

        return $this->controller;
    }

    /**
     * Separa a uri da url
     *
     * @return void
     */
    private function setRequestUri(){
        $scriptName = $_SERVER['SCRIPT_NAME']; // <-- "/foo/index.php"
        $requestUri = $_SERVER['REQUEST_URI']; // <-- "/foo/bar?test=abc" or "/foo/index.php/bar?test=abc"
        $queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : ''; // <-- "test=abc" or ""

        if(strpos($requestUri, $scriptName) !== false){
            $physicalPath = $scriptName; // <-- Without rewriting
        }else{
            $physicalPath = str_replace('\\', '', dirname($scriptName)); // <-- With rewriting
        }

        $env['SCRIPT_NAME'] = rtrim($physicalPath, '/'); // <-- Remove trailing slashes

        $this->requestUri = rawurldecode($this->requestUri);
        $env['PATH_INFO'] = substr_replace($requestUri, '', 0, strlen($physicalPath)); // <-- Remove physical path
        $env['PATH_INFO'] = str_replace('?' . $queryString, '', $env['PATH_INFO']); // <-- Remove query string
        $this->requestUri = '/' . trim($env['PATH_INFO'], '/'); // <-- Ensure leading slash
    }

    public function addRoute($routeId, $rule, $controller, $keywords = array(), $params = array(), $conditions = array()){
        $regexp = preg_quote($rule, '#');
        if($keywords){
            $transformKeywords = array();
            preg_match_all('#\\\{(([^{}]*)\\\:)?(' . implode('|', array_keys($keywords)) . ')(\\\:([^{}]*))?\\\}#', $regexp, $m);

            for($i = 0, $total = count($m[0]); $i < $total; $i++){
                $prepend = $m[2][$i];
                $keyword = $m[3][$i];
                $append = $m[5][$i];
                $transformKeywords[$keyword] = array(
                    'required' => isset($keywords[$keyword]['param']),
                    'prepend' => stripslashes($prepend),
                    'append' => stripslashes($append),
                );

                $prependRegexp = $appendRegexp = '';
                if($prepend || $append){
                    $prependRegexp = '(' . preg_quote($prepend);
                    $appendRegexp = preg_quote($append) . ')?';
                }

                if(isset($keywords[$keyword]['param'])){
                    $regexp = str_replace($m[0][$i], $prependRegexp . '(?P<' . $keywords[$keyword]['param'] . '>' . $keywords[$keyword]['regexp'] . ')' . $appendRegexp, $regexp);
                }else{
                    $regexp = str_replace($m[0][$i], $prependRegexp . '(' . $keywords[$keyword]['regexp'] . ')' . $appendRegexp, $regexp);
                }
            }
            $keywords = $transformKeywords;
        }
        $regexp = '#^/' . $regexp . '(\?.*)?$#u';



        $this->routes[$routeId] = array(
            'rule' => $rule,
            'regexp' => $regexp,
            'controller' => $controller,
            'keywords' => $keywords,
            'params' => $params,
            'conditions' => $conditions
        );
    }

    public function getParam($key){
        if(array_key_exists($key, $this->params)){
            return $this->params[$key];
        }
    }

    private function loadRoutes(){
        $this->addRoute(0, '/', 'index');
        $this->addRoute(1, '/demo(/:type)(/:demo)', 'demo');
    }

}
