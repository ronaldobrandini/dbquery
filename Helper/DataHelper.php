<?php

namespace Helper;
/**
 * Description of DataHelper
 *
 * @author desenvolvimento
 */
abstract class DataHelper
{
    /**
     * Converte os valores passados para formar a string da consulta 
     * corretamente.
     * 
     * @param mixed $value Valor a ser testado
     * @return mixed Retorna o valor convertido
     */
    public static function transform($value, $stringForces){
        if(is_array($value)){
            $strAux = array();
            foreach($value as $x){
                if(is_integer($x)){
                    $strAux[] = $x;
                }else if(is_string($x)){
                    $strAux[] = "'{$x}'";
                }
            }
            $result = '(' . implode(', ', $strAux ) . ')';
        }else if(is_string($value) && $stringForces){
            $result = "'{$value}'";
        }else if(is_null($value)){
            $result = 'null';
        }else if(is_bool($value)){
            $result = ($value) ? 'true' : 'false';
        }else if($value instanceof \DBQuery\SqlInstruction){
            $result = '(' . $value->getInstruction() . ')';
        }else if($value instanceof \DBQuery\SqlBetween){
            $result = $value->dump();
        }else{
            $result = $value;
        }
        return $result;
    }
}
