<?php
//Estancia a classe SqlCriteria
$criteria = new \core\data\dbquery\SqlCriteria();
//Adiciona um filtro de seleção
$criteria->add(new core\data\dbquery\SqlFilter('id', '=', 1));

//Estancia a classe SqlDelete
$delete = new \core\data\dbquery\SqlDelete();
//Define o nome da tabela a ser manipulada
$delete->setEntity('usuario');

//Adiciona o critério de seleção ao delete
$delete->setCriteria($criteria);

//Exibe a string gerada com o comando delete
echo $delete->getInstruction();

