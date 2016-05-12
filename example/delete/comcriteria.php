<?php

use core\data\dbquery\SqlCriteria;
use core\data\dbquery\SqlFilter;
use core\data\dbquery\SqlDelete;

//Estancia a classe SqlCriteria
$criteria = new SqlCriteria();
//Adiciona um filtro de seleção
$criteria->add(new SqlFilter('id', '=', 1));

//Estancia a classe SqlDelete
$delete = new SqlDelete();
//Define o nome da tabela a ser manipulada
$delete->setEntity('usuario');

//Adiciona o critério de seleção ao delete
$delete->setCriteria($criteria);

//Exibe a string gerada com o comando delete
echo $delete->getInstruction();

