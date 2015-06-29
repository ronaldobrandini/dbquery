<?php
//Estância a class SqlJoin
$sqlJoin = new \core\data\dbquery\SqlJoin('INNER', 'usuario');
//Adiciona um filtro ao join
$sqlJoin->addFilter('idUsuario', '=', 'id');
//Adiciona um segundo Filtro
$sqlJoin->addFilter('ativo', '=', 1, \core\data\dbquery\SqlExpression::AND_OPERATOR);
//Exibe a string formada pelo sqljoin
echo $sqlJoin->getInstruction();

