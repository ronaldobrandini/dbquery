<?php

use core\data\dbquery\SqlInsert;

//Cria a instancia da classe SqlInsert
$insert = new SqlInsert();

//Define o nome da tabela
$insert->setEntity('Cliente');

//Define os dados que serão inseridos com o nome do campo e download
$insert->setRowData('nome', 'Ronaldo');
$insert->setRowData('email', 'email@email.com');
$insert->setRowData('idade', '20');

echo $insert->getInstruction();

