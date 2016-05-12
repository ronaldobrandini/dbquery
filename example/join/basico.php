<?php
use core\data\dbquery\SqlJoin;
use core\data\dbquery\SqlExpression;

//Estância a class SqlJoin
$sqlJoin = new SqlJoin(SqlExpression::_INNER_, 'usuario');
//Adiciona um filtro ao join
$sqlJoin->add('idUsuario', '=', 'id');
//Exibe a string formada pelo sqljoin
echo $sqlJoin->getInstruction();
