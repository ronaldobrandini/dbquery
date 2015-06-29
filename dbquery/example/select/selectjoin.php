<?php
//Define o join
$sqlJoin = new \core\data\dbquery\SqlJoin('INNER', 'setor');
$sqlJoin->addFilter('idSetor', '=', 'id');

//Define o select com dados das colunas e tabela
$select = new \core\data\dbquery\SqlSelect();
$select->setEntity('usuario');
$select->addColumn('*');

//Adiciona o join ao select
$select->setJoin($sqlJoin);

//Retorna a string com o select montado
echo $select->getInstruction();

