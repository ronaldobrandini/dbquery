<?php

use \core\data\dbquery\SqlCriteria;
use \core\data\dbquery\SqlFilter;
use \core\data\dbquery\SqlSelect;
use \core\data\dbquery\SqlExpression;

//Estância a classe SqlCriteria para o critério da subquery
$criteriaSubquery = new SqlCriteria();

//Adiciona os filtros de seleção para o critério da subquery
$criteriaSubquery->add(new SqlFilter('idAparelho', '=', 'C.de', false), SqlExpression::_OR_);
$criteriaSubquery->add(new SqlFilter('idAparelho', '=', 'C.para', false), SqlExpression::_OR_);

//Estância a classe SqlSelect para criar a subquery
$subquery = new SqlSelect();
//Defina a tabela da subquery
$subquery->setEntity('ChatMensagemLida');
//Define as colunas da subquery
$subquery->addColumn('idChat');
//Adiciona o critério ao select
$subquery->setCriteria($criteriaSubquery);

//Estância a classe SqlCriteria para o critério 
$criteria = new SqlCriteria();
//Adiciona o filtro com a subquery
$criteria->add(new SqlFilter('id', SqlExpression::_NOT_IN_, '(' . $subquery->getInstruction() . ')', false));

//Exibe o critério montado
echo $criteria->dump();