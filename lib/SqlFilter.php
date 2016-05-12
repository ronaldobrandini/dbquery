<?php

namespace lib;
/**
 * 
 * Public Class SqlFilter
 * 
 * Classe responsavel pela criação de um filtro na clausula where
 * 
 * @package core.data.dbquery
 * @access public
 * @author Ronaldo Silva <ronaldo.silva@xsystems.com.br>
 * @version 1.0 29/06/2014
 */
class SqlFilter extends SqlExpression{
    /**
     *
     * @var string Valor utilizado para comparação <b>Ex:</b><br>
     * coluna ou C.coluna 
     */
    private $variable;
    /**
     *
     * @var string Operador utilizado na consulta <b>Ex:</b><br>
     * =, <>, < >, in, not in, etc..
     */
    private $operator;
    /**
     *
     * @var mixed Valor do filtro
     */
    private $value;
    /**
     * 
     * @param string $variable Valor utilizado para comparação <b>Ex:</b><br>
     * coluna ou C.coluna 
     * @param string $operator Operador utilizado na consulta <b>Ex:</b><br>
     * =, <>, < >, in, not in, etc..
     * @param mixed $value Valor da clausula, caso seja uma string tratára 
     * sqlInjection e acresentara "", caso booleano convertera para string 'true' 
     * ou 'false', caso NULL convertera para string 'null' e caso number sera
     * mantido como foi passado.
     * @param type $stringForces
     */
    public function __construct($variable, $operator, $value, $stringForces = true){
        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $this->transform($value, $stringForces);
        
    }
    /**
     * Converte os valores passados para formar a string da consulta 
     * corretamente.
     * 
     * @param mixed $value Valor a ser testado
     * @return mixed Retorna o valor convertido
     */
    private function transform($value, $stringForces){
        if(is_array($value)){
            $strAux = array();
            foreach($value as $x){
                if(is_integer($x)){
                    $strAux[] = $x;
                }else if(is_string($x)){
                    $strAux[] = '"' . $x . '"';
                }
            }
            $result = '(' . implode(', ', $strAux ) . ')';
        }else if(is_string($value) && $stringForces){
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
    /**
     * Retorna a string já formatada
     * @return string Retorna o filtro coluna = valor
     */
    public function dump(){
        return "{$this->variable}{$this->operator}{$this->value}";
    }
}
