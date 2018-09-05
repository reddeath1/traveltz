<?php
/**
 * Created by PhpStorm.
 * User: reddeath
 * Date: 8/28/2018
 * Time: 2:23 AM
 */

$dir = str_replace('controller','',__DIR__);

include_once ($dir.'model/main.class.php');
class Locations extends Main
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getLocations($str = ''){
        echo 'Locations ';

        $loc = parent::getLocations($str);

        print_r($loc);

        // print_r(parent::getLocations($str))*/


       return parent::getLocations($str);
    }
}
