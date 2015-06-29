<?php
namespace core\data\dbquery;
abstract class SqlExpression {
    const AND_OPERATOR = ' AND ';
    const OR_OPERATOR = ' OR ';
    const ON_OPERATOR = ' ON ';
    abstract public function dump();
}
