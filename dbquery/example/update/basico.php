<?php
//Estancia a classe SqlUpdate
$update = new core\data\dbquery\SqlUpdate();

//Defina a tabela a ser manipulada
$update->setEntity('usuario');

//Defina as colunas que serão alteradas e seus devidos valores
$update->setRowData('nome', 'Ronaldo');

//Exibe o conteudo da string de update gerada
echo $update->getInstruction();

