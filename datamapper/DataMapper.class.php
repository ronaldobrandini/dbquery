<?php
namespace datamapper;
interface DataMapper{
    public function save();
    public function load();
    public function update(\db\SqlCriteria $criteria);
    public function delete(\db\SqlCriteria $criteria);
}
