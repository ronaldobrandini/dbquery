<?php
//Define o critério de seleção
$criteria = new \core\data\dbquery\SqlCriteria();
$criteria->add(new core\data\dbquery\SqlFilter('id', '=', 1));

//Define o select com dados das colunas e tabela
$select = new \core\data\dbquery\SqlSelect();
$select->setEntity('usuario');
$select->addColumn('*');

//Acrescenta o critério de seleção ao select
$select->setCriteria($criteria);
//Retorna a string com o select montado
echo $select->getInstruction();

