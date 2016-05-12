<?php
namespace lib;
/**
 * 
 */
class SqlCriteria extends SqlExpression{
    private $expressions = array();
    private $operators = array();
    private $properties = array();
    
    public function __construct(){
        $this->expressions = array();
        $this->operators = array();
    }
    /**
     * 
     * @param lib\SqlExpression $expression
     * @param string $operador
     */
    public function add(SqlExpression $expression, $operador = self::_AND_){
        if(empty($this->expressions)){
            $operador = NULL;
        }
        
        $this->expressions[] = $expression;
        $this->operators[] = $operador;
    }
    /**
     * 
     * @return string
     */
    public function dump(){
        if(is_array($this->expressions)){
            if(count($this->expressions) > 0){
                $result = '';
                foreach($this->expressions as $i => $expression){
                    $operator = $this->operators[$i];
                    $result .= $operator . $expression->dump();
                }
                $result = trim($result);
                return "({$result})";
            }
        }
    }
    /**
     * 
     * @param string $property
     * @param mixed $value
     */
    public function setProperty($property, $value){
        if(is_null($value)){
            throw new \InvalidArgumentException('The value of property ' . $property . ' can not be null.');
        }
        if (isset($value) && !empty($value) && strlen($value) > 0){
            $this->properties[$property] = $value;
        }else{
            $this->properties[$property] = false;
        }
    }
    /**
     * 
     * @param type $property
     * @return string
     */
    public function getProperty($property){
        if (array_key_exists($property, $this->properties)){
            return $this->properties[$property];
        }
        return false;
    }
    
}
