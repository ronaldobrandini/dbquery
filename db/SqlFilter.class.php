<?php
namespace db;
class SqlFilter extends SqlExpression{
    private $variable;
    private $operator;
    private $value;
    
    public function __construct($variable, $operator, $value){
        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $this->transform($value);
    }
    
    private function transform($value){
        if(is_array($value)){
            $strAux = array();
            foreach($value as $x){
                if(is_integer($x)){
                    $strAux[] = $x;
                }else if(is_string($x)){
                    $strAux[] = '"' . $x . '"';
                }
            }
            $result = implode(', ', $strAux );
        }else if(is_string($value)){
            $result = '"' . $value . '"';
        }else if(is_null($value)){
            $result = 'null';
        }else if(is_bool($value)){
            $result = ($value) ? 'true' : 'false';
        }else{
            $result = $value;
        }
        return $result;
    }
    
    public function dump(){
        return "{$this->variable} {$this->operator} {$this->value}";
    }
}
