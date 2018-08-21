<?php
include_once('controller/main.class.php');


class Index extends Main{
    public function __construct(){
        parent::__construct();

        $url = $this->Url();
        include_once('header.php');
        (isset($_GET['action']) && !empty($_GET['action'])) ? $action = $_GET['action'] : $action = '';
        (isset($_GET['q']) && $_GET['q'])  ? $q = htmlentities($_GET['q']) : $q = '';
        
        
        $file = 'view/'.$action.'.php';
        
        if(!file_exists($file)){
            $file = 'view/home.php';
        }
        
        include ($file);
        
        include_once('footer.php');
    }
}

new Index();
?>