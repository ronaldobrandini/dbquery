<?php
    require_once 'core/config/cfg.php';
    core\Dispatcher::getInstance()->dispatch();

die();

$sqlCriteria = new \db\SqlCriteria();

$sqlCriteria->add(new \db\SqlFilter('S.id_regiao', '=', 15), \db\SqlExpression::OR_OPERATOR);
$sqlCriteria->add(new SqlFilter('C.id_setor', '=', 65));
$sqlCriteria->add(new SqlFilter('C.col_dt_visita', '>=', '2014-02-01 00:00:00'));
$sqlCriteria->add(new SqlFilter('C.col_dt_visita', '<=', '2014-03-01 00:00:00'));

$sqlCriteria->setProperty('order', 'C.col_dt_visita, S.set_nome, C.col_dt_cadastro, L.loj_nome');

$joinLoja = new SqlJoin('LEFT', 'tb_loja L');
$joinLoja->addFilter('C.id_loja', '=', 'L.id_loja');

$joinSetor = new SqlJoin('LEFT', 'tb_setor S');
$joinSetor->addFilter('C.id_setor', '=', 'S.id_setor');

$joinRegiao = new SqlJoin('LEFT', 'tb_regiao R');
$joinRegiao->addFilter('R.id_regiao', '=', 'S.id_regiao');

$joinUsuario = new SqlJoin('LEFT', 'tb_usuario U');
$joinUsuario->addFilter('C.id_usuario', '=', 'U.id_usuario');
$joinUsuario->addFilter('U.id_setor', '=', 'C.id_setor', 'AND');

$sqlSelect = new SqlSelect();

$sqlSelect->setEntity('tb_coleta C');
$sqlSelect->addColumn('C.*');
$sqlSelect->addColumn('R.reg_nome');
$sqlSelect->addColumn('L.loj_nome');
$sqlSelect->addColumn('L.loj_cnpj');
$sqlSelect->addColumn('loj_endereco');
$sqlSelect->addColumn('loj_complemento');
$sqlSelect->addColumn('loj_bairro');
$sqlSelect->addColumn('loj_cidade');
$sqlSelect->addColumn('loj_estado');
$sqlSelect->addColumn('loj_ddd_fone');
$sqlSelect->addColumn('loj_num_fone');
$sqlSelect->addColumn('loj_ddd_fone2');
$sqlSelect->addColumn('loj_num_fone2');
$sqlSelect->addColumn('set_nome');
$sqlSelect->addColumn('usu_nome');

$sqlSelect->setCriteria($sqlCriteria);
$sqlSelect->setJoin($joinUsuario);
$sqlSelect->setJoin($joinSetor);
$sqlSelect->setJoin($joinRegiao);
$sqlSelect->setJoin($joinLoja);

echo $sqlSelect->getInstruction();



