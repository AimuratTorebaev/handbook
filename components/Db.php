<?php

class Db {
    
    use Singleton;
    
    protected $dbh;
    public static $l;

    protected function __construct() {
        
        $this->dbh = new PDO('mysql:host=127.0.0.1;dbname=aimurat', 'aimurat', 'qawsedrftg');
        $this->dbh->exec('SET NAMES utf8');
        
    }
    
    public function execute($sql, $params = []){
        
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        self::$l = $this->dbh->lastInsertId();
        return $res;
    }
    
    public function query($sql, $params, $class){
        
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        
        if(false !== $res){
            return $sth->fetchAll(PDO::FETCH_CLASS, $class);
        }
        
        return [];
    }

}
