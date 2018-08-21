<?php 

class Main{

    public function __construct(){
        
    }

    public function Url(){
        $page_url   = 'http';
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
            $page_url .= 's';
        }

        $name = $page_url.'://'.$_SERVER['SERVER_NAME'];

         if(preg_match('/localhost/',$name)){
             $name = $name. '/Traveltz';
         }

        return $name;
    }
}
?>
