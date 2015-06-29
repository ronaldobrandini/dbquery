<?php
//Estancia a classe SqlDelete
$delete = new \core\data\dbquery\SqlDelete();
//Define o nome da tabela a ser manipulada
$delete->setEntity('usuario');
//Exibe a string gerada com o comando delete
echo $delete->getInstruction();