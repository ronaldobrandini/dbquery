<?php

use core\data\dbquery\SqlCriteria;
use core\data\dbquery\SqlFilter;
use core\data\dbquery\SqlSelect;

//Define o critério de seleção
$criteria = new SqlCriteria();
$criteria->add(new SqlFilter('id', '=', 1));

//Define o select com dados das colunas e tabela
$select = new SqlSelect();
$select->setEntity('usuario');
$select->addColumn('*');

//Acrescenta o critério de seleção ao select
$select->setCriteria($criteria);
//Retorna a string com o select montado
echo $select->getInstruction();

