<?php

use core\data\dbquery\SqlJoin;
use core\data\dbquery\SqlSelect;

//Define o join
$sqlJoin = new SqlJoin('INNER', 'setor');
$sqlJoin->add('idSetor', '=', 'id');

//Define o select com dados das colunas e tabela
$select = new SqlSelect();
$select->setEntity('usuario');
$select->addColumn('*');

//Adiciona o join ao select
$select->setJoin($sqlJoin);

//Retorna a string com o select montado
echo $select->getInstruction();

