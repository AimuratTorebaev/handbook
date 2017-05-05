<?php

abstract class Model
{

    const TABLE = '';
    public $id;
    
    public static function findAll()
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }
   
    public static function findByID($id)
    {
        $db = Db::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE id=:id',
            [':id' => $id],
            static::class
        )[0];
    }
    
    public function isNew(){
        
        return empty($this->id);
    }

    public function insert(){
        
        if (!$this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if ('id' == $k) {
                continue;
            }
            $columns[] = $k;
            $values[':'.$k] = $v;
        }

        $sql = '
                INSERT INTO ' . static::TABLE . '
                (' . implode(',', $columns) . ')
                VALUES
                (' . implode(',', array_keys($values)) . ')
                ';
 
        $db = Db::instance();
        $res = $db->execute($sql, $values);
        return $res;
    } 
    /*
    public function fill($p){
        foreach ($p as $k=>$v){
            if(is_numeric($v)){
                $v = Ancillary::clearInt($v);
                $values[$$k] = $v;
            }elseif(is_string($v)){
                $v = Ancillary::clearStr($v);
                $values[$$k] = $v;
            }
            return $values; 
        }
    }*/
}