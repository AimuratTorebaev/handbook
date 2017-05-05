<?php

class PaymentController {
    protected $view;

    public function __construct() {
        $this->view = new View();
    }
    
    public function actionView($id){
        $this->view->payment = false;
        if(isset($_POST['submit'])){
            $payment = new Payment();
            $payment->month = Ancillary::converter(($_POST['month']));  
            $payment->wage = Ancillary::clearInt($_POST['wage']);
            $payment->id_worker = $id;
            $p = Worker::findByID($id);
            $payment->worker_profession_id = $p->profession_id;
            $this->view->payment = $payment->insert();
          
        }
        $this->view->display(ROOT . '/views/payment/add.php');die;
    }
}
