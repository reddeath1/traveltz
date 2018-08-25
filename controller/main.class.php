<?php 

class Main{

    public function __construct(){
        
    }

    /**
     * Get url
     */
    public function Url(){
        $page_url   = 'http';
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
            $page_url .= 's';
        }

        $name = $page_url.'://'.$_SERVER['SERVER_NAME'];

        (preg_match('/(localhost)/', $name)) ? $name .= '/traveltz' : $name;

        return $name;
    }
}
?>
