<?php

use core\data\dbquery\SqlCriteria;
use core\data\dbquery\SqlFilter;
use core\data\dbquery\SqlUpdate;

//Estancia a classe SqlCriteria
$criteria = new SqlCriteria();
//Adiciona um filtro de seleção
$criteria->add(new SqlFilter('id', '=', 1));

//Estancia a classe SqlUpdate
$update = new SqlUpdate();

//Defina a tabela a ser manipulada
$update->setEntity('usuario');

//Defina as colunas que serão alteradas e seus devidos valores
$update->setRowData('nome', 'Ronaldo');

//Adiciona o critério de seleção ao update
$update->setCriteria($criteria);

//Exibe o conteudo da string de update gerada
echo $update->getInstruction();

