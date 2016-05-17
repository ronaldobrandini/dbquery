<?php

namespace lib;
use Helper\DataHelper;
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
     * @var string Operador utilizado na consulta <b>Ex:</b>
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
     * @param string $variable Valor utilizado para comparação <b>Ex:</b>
     * coluna ou C.coluna 
     * @param string $operator Operador utilizado na consulta <b>Ex:</b>
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
        $this->value = DataHelper::transform($value, $stringForces);
        
    }
    
    /**
     * Retorna a string já formatada
     * @return string Retorna o filtro coluna = valor
     */
    public function dump(){
        return "{$this->variable}{$this->operator}{$this->value}";
    }
}
