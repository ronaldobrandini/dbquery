<?php
namespace lib;
abstract class SqlExpression {
    const _LIMIT_ = ' LIMIT ';
    const _ORDER_ = ' ORDER BY ';
    const _OFFSET_ = ' OFFSET ';
    const _AND_ = ' AND ';
    const _OR_ = ' OR ';
    const _ON_ = ' ON ';
    const _IN_ = ' IN ';
    const _NOT_IN_ = ' NOT IN ';
    const _BETWEEN_ = ' BETWEEN ';
    const _INNER_ = ' INNER ';
    const _LEFT_ = ' LEFT ';
    const _FULL_ = ' FULL ';
    const _EQUAL_ = ' = ';
    const _IS_ = ' IS ';
    const _IS_NOT_ = ' IS NOT ';

    abstract public function dump();
}
