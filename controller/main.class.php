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

        // if(preg_match('/localhost/',$name)){
        //     $name = $name. '/nevaa';
        // }else if(preg_match("/192.168.42.200/",$name)){
        //     $name = $name."/nevaa";
        // }

        return $name;
    }
}

?>