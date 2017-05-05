<?php

class Payment extends Model {
    public $id;
    public $wage;
    public $month;
    public $id_worker;
    public $worker_profession_id;

    const TABLE = 'payment';
    
    public static function findWage($id_worker){
        $m = Ancillary::getMonth();   
        $db = Db::instance();
        return $db->query(
            'SELECT id,wage FROM ' . static::TABLE . ' WHERE id_worker=:id_worker AND MONTH(month)= :month',
            [':id_worker' => $id_worker, ':month' => $m],
            static::class
        )[0];
    }
    
    public static function addPremiumByProfession($wage, $worker_profession_id){
        $month = Ancillary::getMonth();
        if(0 == $month){
            $month = date('m');
        }
        $sql = 'UPDATE '.static::TABLE.' SET wage = wage + '.$wage
                .' WHERE worker_profession_id = '.$worker_profession_id
                .' AND MONTH(month)= '.$month;
        $db = Db::instance();
        $db->execute($sql);
    }
}
