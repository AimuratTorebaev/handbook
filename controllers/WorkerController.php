<?php

class WorkerController {
    
    protected $view;

    public function __construct() {
        $this->view = new View();
    }
    
    public function actionAdd(){
        $this->view->payment = false;
        $this->view->worker = false;
        if(isset($_POST['submit'])){
        $worker = new Worker();
        $worker->name = Ancillary::clearStr($_POST['name']);
        $worker->surname = Ancillary::clearStr($_POST['surname']);
        $profession = $_POST['profession_id'];
        $prof = Profession::findByID($profession);
        $worker->profession_id = $prof->id;  
        $this->view->worker = $worker->insert();
        Ancillary::addImage(Db::$l);
        
        $payment = new Payment();
        $payment->month = Ancillary::converter(($_POST['month']));  
        $payment->wage = Ancillary::clearInt($_POST['wage']);
        $payment->id_worker = Db::$l;
        $payment->worker_profession_id = $worker->profession_id;
        $this->view->payment = $payment->insert();
        }
        $this->view->display(ROOT . '/views/workers/add.php');
        return true;
    }
}
 