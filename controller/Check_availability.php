<?php
/**
 * Created by PhpStorm.
 * User: FrankGalos
 * Date: 9/1/2018
 * Time: 1:34 AM
 */

include_once 'main.class.php';
class Check_availability extends Main
{
    public function __construct()
    {
        parent::__construct();
        echo  $this->encode(array('status'=>'jajajaj'));
    }



    
}