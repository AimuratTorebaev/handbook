<?php


class WorkersController
{
    protected $view;

    public function __construct() {
        $this->view = new View();
    }
    
    public function actionIndex(){ 
        
        if(isset($_POST['currency'])){
            $_SESSION['curency'] = $_POST['currency'];
            header("Location: /");  
        }
        
        if(isset($_POST['submit2'])){ 
            $profession = $_POST['profession_id'];
            $wage = $_POST['wage'];  
            Payment::addPremiumByProfession($wage, $profession);
            header("Location: /");
        }
        
        $cbr = new Currency();
        $this->view->usd_curs = $cbr->check($cbr);
        $cur = Ancillary::isCurSet();
        $this->view->curency = Ancillary::cur($cur);
        $this->view->calendar = Ancillary::calendar(array(date("Y-m-d")));
        $this->view->workers = Worker::findAll();      
        $this->view->display(ROOT . '/views/workers/index.php');
        
    }
    
   
    
    public function actionCalendar($m, $y){
        
        if(isset($_POST['currency'])){
            $_SESSION['curency'] = $_POST['currency'];
            header('Location: /'.$m.'/'.$y);  
        }
        
        if(isset($_POST['submit2'])){ 
            $profession = $_POST['profession_id'];
            $wage = $_POST['wage'];  
            Payment::addPremiumByProfession($wage, $profession);
            header("Location: /");
        }
        
        $cbr = new Currency();
        $this->view->usd_curs = $cbr->check($cbr);
        $cur = Ancillary::isCurSet();
        $this->view->curency = Ancillary::cur($cur);
        $this->view->calendar = Ancillary::calendar(array(date("Y-m-d")),$m,$y);
        $this->view->workers = Worker::findAll();      
        $this->view->display(ROOT . '/views/workers/index.php');
        return true;
    }

}
