<?php
use lib\SqlSelect;

//Estancia a classe select
$select = new SqlSelect();

//Define a tabela/entidade
$select->setEntity('usuario');

//Adiciona coluna
$select->addColumn('*');

//Retorna a query
echo $select->getInstruction();

