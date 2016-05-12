<?php
use core\data\dbquery\SqlJoin;
use core\data\dbquery\SqlExpression;

//Estância a class SqlJoin
$sqlJoin = new \core\data\dbquery\SqlJoin(SqlExpression::_LEFT_, 'usuario');
//Adiciona um filtro ao join
$sqlJoin->add('idUsuario', '=', 'id');
//Adiciona um segundo Filtro
$sqlJoin->add('ativo', '=', 1, SqlExpression::_AND_);
//Exibe a string formada pelo sqljoin
echo $sqlJoin->getInstruction();

