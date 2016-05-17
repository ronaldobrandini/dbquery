<?php
namespace DBQuery;


class SqlUpdate extends SqlInstruction{
    
   
    
    public function getInstruction(){
        $this->sql = "UPDATE {$this->entity}";
        if ($this->columnValues){
            foreach ($this->columnValues as $column => $value){
                $set[] = "{$column} = {$value}";
            }
        }
        $this->sql .= ' SET ' . implode(', ', $set);
        if ($this->criteria){
            $this->sql .= ' WHERE ' . $this->criteria->dump();
        }
        return $this->sql;
    }
}
