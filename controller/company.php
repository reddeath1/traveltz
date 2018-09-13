<?php
/**
 * Created by PhpStorm.
 * User: reddeath
 * Date: 9/13/2018
 * Time: 9:49 PM
 */
$dir = str_replace('controller','',__DIR__);

include_once ($dir.'/model/main.class.php');
class company extends  Main
{

    public  function __construct()
    {
        parent::__construct();
    }


}