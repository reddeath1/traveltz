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
    private $url;

   public function __construct()
   {
       parent::__construct();
       $this->url = $this->Url();
       
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

             $sort = (isset($_POST['sort']) && !empty($_POST['sort'])) ? $_POST['sort'] : '';

           /**
            * @params sort parameters
            */
             $params = array('d'=>$d,'from'=>$from,'to'=>$to,'filter'=>$filter,'sort'=>$sort,'limit'=>'');

           /**
            * @result fetch the data
            */
           $result = '';
           $data = $this->get_av_result($this->encode($params));

            $feature = '';

            if(count($data) > 0){

                foreach ($data as $item) {
                    $bid = strtoupper($item['id']);
                    $company = strtoupper($item['company']);
                    $features = $item['features'];
                    $seats = (int) $item['seats_count'] -1 ;
                    $route = $item['route'];
                    $depature = $item['dep_date'];
                    $price = $item['price'].'Tzs';
                    $bus_no = $item['bus_no'];
                    $bus_name = $item['name'];
                    $logo = $item['logo'];


                    $available_seats = (int) $this->get_av_seats($bid);

                    $available_seats = ($seats - $available_seats);


                    if(preg_match("/tv/i", $features))
                    {
                        $feature .= '<ion-icon name="tv"></ion-icon>';
                    }

                    if(preg_match("/ac/i", $features)){

                    }

                    if(preg_match("/wifi/i", $features)){
                            $feature .= '<ion-icon ios="ios-wifi" md="md-wifi"></ion-icon>';
                    }

                    if(preg_match("/drinks/i", $features)){
                        $feature .= '<ion-icon name="cafe"></ion-icon>';
                    }

                    if(preg_match("/charge/i", $features)){
                        $feature .= '<ion-icon name="battery-charging"></ion-icon>';
                    }

                    $logo = $this->url."/view/public/images/busLogo/$logo";
                    $time = date('H:i',strtotime($depature)).'Hrs';

                    (!empty($bid)) ? $result .= "<div class=\"container res-0\">
					<div class=\"card\">
						<div class=\"container\">
							<div class=\"row text-center\">
								<div class=\"col-sm image-0\">
									<img src=\"$logo\" class=\"rounded img-fluid\" alt=\"$bus_name\">
									<h6 class=\"mt-2\">$company</h6>
                                 	<p class=\"bus-number\">$bus_no</p>
								</div>
								<div class=\"col-sm route\">
									<p class=\"mt-2\">ROUTE:<br><strong> $route </strong></p>

									<p>DEPARTURE TIME:<br><strong>$time</strong></p>
									<p>ETA:&nbsp;<strong>4Hrs</strong></p>
                                    </div>
								<div class=\"col-sm amenities mt-2\">
									$feature
									<p class=\"mt-2\"><strong>PRICE:<br></strong>Starts from&nbsp;<strong>$price</strong></p>
									<p><strong>SEATS AVAILABLE:&nbsp;($available_seats)</strong></p>

								</div>
								<div class=\"col-sm align-self-center\">
									<a href=\"$this->url/seater/$bid\" class=\"btn btn-banner\">Book Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>" : $this->message = 'No records found';
               }
            }else{
               $this->message = "No records found!";
            }

            print_r((!empty($result) ? $this->encode(array('data'=>$result,'count'=>count($data))) : ''));
       }else{
           $this->message = "All fields are required";
       }
   }
}

new Requests();
