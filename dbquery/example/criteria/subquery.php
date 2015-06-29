<?php
//Estância a classe SqlCriteria para o critério da subquery
$criteriaSubquery = new \core\data\dbquery\SqlCriteria();

//Adiciona os filtros de seleção para o critério da subquery
$criteriaSubquery->add(new \core\data\dbquery\SqlFilter('idAparelho', '=', 'C.de', false), \core\data\dbquery\SqlExpression::OR_OPERATOR);
$criteriaSubquery->add(new \core\data\dbquery\SqlFilter('idAparelho', '=', 'C.para', false), \core\data\dbquery\SqlExpression::OR_OPERATOR);

//Estância a classe SqlSelect para criar a subquery
$subquery = new \core\data\dbquery\SqlSelect();
//Defina a tabela da subquery
$subquery->setEntity('ChatMensagemLida');
//Define as colunas da subquery
$subquery->addColumn('idChat');
//Adiciona o critério ao select
$subquery->setCriteria($criteriaSubquery);

//Estância a classe SqlCriteria para o critério 
$criteria = new \core\data\dbquery\SqlCriteria();
//Adiciona o filtro com a subquery
$criteria->add(new \core\data\dbquery\SqlFilter('id', 'not in', '(' . $subquery->getInstruction() . ')', false));

//Exibe o critério montado
echo $criteria->dump();