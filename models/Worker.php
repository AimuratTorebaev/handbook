<?php

class Worker extends Model {
  
    public $id;
    public $name;
    public $surname;
    public $profession_id;
    const TABLE = 'workers';
    
    public function __get($k)
    {
        switch ($k) {
            case 'payment':
                return Payment::findWage($this->id);
                break;
            case 'profession':
                return Profession::findByID($this->profession_id);
                break;
            case 'workerId':
                return $this->id;
                break;
            default:
                return null;
        }
    }
    
    public function __isset($k)
    {
        switch ($k) {
            case 'payment':
                return !empty($this->id);
                break;
            case 'profession':
                return !empty($this->profession_id);
                break;
            default:
                return false;
        }
    }
    
}
