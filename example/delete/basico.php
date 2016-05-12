<?php

use core\data\dbquery\SqlDelete;

//Estancia a classe SqlDelete
$delete = new SqlDelete();

//Define o nome da tabela a ser manipulada
$delete->setEntity('usuario');

//Exibe a string gerada com o comando delete
echo $delete->getInstruction();