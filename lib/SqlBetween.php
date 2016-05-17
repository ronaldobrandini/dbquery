<?php

namespace lib;
use lib\SqlFilter;
use lib\SqlExpression;
use Helper\DataHelper;
/**
 * Description of SqlBetween
 *
 * @author desenvolvimento
 */
class SqlBetween extends SqlExpression
{
    /**
     *
     * @var Mixed 
     */
    private $value;
    /**
     * 
     * @param mixed $valueIni Initial Value
     * @param string $operator Logic operator
     * @param mixed $valueEnd   End value
     * @param boolean $stringForces Forces parentheses into a string
     */
    public function __construct($valueIni, $operator, $valueEnd, $stringForces = true)
    {
        $valueIni = DataHelper::transform($valueIni, $stringForces);
        $valueEnd = DataHelper::transform($valueEnd, $stringForces);
        
        $this->value = "{$valueIni}{$operator}{$valueEnd}";
    }
    /**
     * 
     * @return mixed
     */
    public function dump()
    {
        return $this->value;
    }

}
