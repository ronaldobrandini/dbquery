<?php
//Estância a class SqlJoin
$sqlJoin = new \core\data\dbquery\SqlJoin('INNER', 'usuario');
//Adiciona um filtro ao join
$sqlJoin->addFilter('idUsuario', '=', 'id');
//Exibe a string formada pelo sqljoin
echo $sqlJoin->getInstruction();
