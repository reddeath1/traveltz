<?php

/**
 * Disable caches
 */

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


include_once (__DIR__.'/model/Locations.php');


class Index {
    public function __construct(){


        /**
         * Load modules
         */

     $locations = new Locations();
     $locations = $locations->getLocations();
     $location_names = '';

        foreach ($locations as $location) {
            $lid = $location['id'];
            $lname = $location['name'];
            $location_names .= "<option value='$lid'>$lname</option>";
        }



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


    /**
     * Get url
     */
    public function Url(){
        $page_url   = 'http';

        (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? $page_url .= 's' : $page_url;

        $name = $page_url.'://'.$_SERVER['SERVER_NAME'];

        (preg_match('/(localhost)/', $name)) ? $name .= '/traveltz' : $name;

        return $name;
    }
}

new Index();
?>