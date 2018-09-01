<?php
/**
 * Created by PhpStorm.
 * User: FrankGalos
 * Date: 9/1/2018
 * Time: 4:08 PM
 */

include_once (str_replace('controller','',__DIR__).'model/main.class.php');
class Requests extends Main
{
    private $message;

   public function __construct()
   {
       parent::__construct();
       $this->message = "Method is not allowed";
       if(isset($_POST['action']) && method_exists($this,$_POST['action'])){
           $action = $_POST['action'];

           /**
            * @reset the message
            */
           $this->message = '';

           /**
            * @execute the action
            */
           $this->$action();
       }

      print_r((!empty($this->message)) ? $this->encode(array('message'=>$this->message)) : $this->message);
   }


   private function get_av_results(){
       if(isset($_POST['d']) && !empty($_POST['d']) &&
           isset($_POST['from']) && !empty($_POST['from']) &&
           isset($_POST['to']) && !empty($_POST['to'])){

           /**
            * @sanitize the params
            */
             $d = preg_replace('#[^0-9a-z-]#i','',$_POST['d']);
             $from = preg_replace('#[^0-9]#i','',$_POST['from']);
             $to = preg_replace('#[^0-9]#i','',$_POST['to']);

             /**
              * @optional parameters
              */
             $filter = (isset($_POST['filter']) && !empty($_POST['filter'])) ?
                  chop($_POST['filter'],',') : '';

             $sort = (isset($_POST['sort']) && !empty($_POST['sort'])) ? $_POST['filter'] : '';

           /**
            * @params sort parameters
            */
             $params = array('d'=>$d,'from'=>$from,'to'=>$to,'filter'=>$filter,'sort'=>$sort);

           /**
            * @result fetch the data
            */
              return $this->get_av_result($this->encode($params));
       }else{
           $this->message = "All fields are required";
       }
   }
}

new Requests();