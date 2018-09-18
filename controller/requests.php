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
           $companies = array();
           $count_companies = array();

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

            $results = array();

            if(count($data) > 0){

                foreach ($data as $item) {
                    $bid = strtoupper($item['id']);
                    $company = strtoupper($item['company']);
                    $features = $item['features'];
                    $seats = (int) $item['seats_count'];
                    $route = $item['route'];
                    $depature = $item['dep_date'];
                    $price = $item['price'].'Tzs';
                    $bus_no = $item['bus_no'];
                    $bus_name = $item['name'];
                    $logo = $item['logo'];
                    $cp_id = $item['cp_id'];


                    $available_seats = (int) $this->get_av_seats($bid);

                    array_push($count_companies,$company);

                    $count_companies = count(array_unique($count_companies));
                    array_push($companies, array('id'=>$cp_id,'name'=> $company));//$this->company($bid,$from,$to)

                    $available_seats = ($seats - $available_seats);


                    if(preg_match("/tv/i", $features))
                    {
                        if(preg_match("/drinks/i", $features) && preg_match("/charge/i", $features)  && preg_match("/ac/i", $features) && preg_match("/wifi/i", $features)){
                            $feature = "<ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon name=\"podium\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(!preg_match("/tv/i", $features) && preg_match("/charge/i", $features)  && preg_match("/ac/i", $features)&& preg_match("/wifi/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && !preg_match("/ac/i", $features) && preg_match("/wifi/i", $features) && preg_match("/charge/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/ac/i", $features) && !preg_match("/wifi/i", $features) && preg_match("/charge/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"podium\"></ion-icon>  <ion-icon name=\"battery-charging\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/ac/i", $features) && !preg_match("/wifi/i", $features) && !preg_match("/charge/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"podium\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else{
                            $feature ='<ion-icon name="cafe"></ion-icon>';
                        }
                    }else if(preg_match("/ac/i", $features)){

                        if(preg_match("/tv/i", $features) && preg_match("/drinks/i", $features) && preg_match("/charge/i", $features) && preg_match("/wifi/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(!preg_match("/tv/i", $features) && preg_match("/drinks/i", $features) && preg_match("/charge/i", $features)  &&  preg_match("/wifi/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && !preg_match("/drinks/i", $features) && preg_match("/charge/i", $features)  &&  preg_match("/wifi/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/drinks/i", $features) && !preg_match("/charge/i", $features)  &&  preg_match("/wifi/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"podium\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/drinks/i", $features) && preg_match("/charge/i", $features)  && !preg_match("/wifi/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"podium\"></ion-icon><ion-icon name=\"battery-charging\"></ion-icon> ";
                        }else{
                            $feature ='<ion-icon name="podium"></ion-icon>';
                        }

                    }else if(preg_match("/wifi/i", $features)){

                        if(preg_match("/tv/i", $features) && preg_match("/drinks/i", $features) && preg_match("/charge/i", $features) && preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(!preg_match("/tv/i", $features) && preg_match("/drinks/i", $features) && preg_match("/charge/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && !preg_match("/drinks/i", $features) && preg_match("/charge/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/drinks/i", $features) && !preg_match("/charge/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"podium\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/drinks/i", $features) && preg_match("/charge/i", $features)  && !preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else{
                            $feature ='<ion-icon ios="ios-wifi" md="md-wifi"></ion-icon>';
                        }

                    }else if(preg_match("/drinks/i", $features)){

                        if(preg_match("/tv/i", $features) && preg_match("/wifi/i", $features) && preg_match("/charge/i", $features) && preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(!preg_match("/tv/i", $features) && preg_match("/wifi/i", $features) && preg_match("/charge/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && !preg_match("/wifi/i", $features) && preg_match("/charge/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/wifi/i", $features) && !preg_match("/charge/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"podium\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/wifi/i", $features) && preg_match("/charge/i", $features)  && !preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else{
                            $feature ='<ion-icon name="cafe"></ion-icon>';
                        }

                    }else if(preg_match("/charge/i", $features)){

                        if(preg_match("/tv/i", $features) && preg_match("/wifi/i", $features) && preg_match("/cafe/i", $features) && preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(!preg_match("/tv/i", $features) && preg_match("/wifi/i", $features) && preg_match("/cafe/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && !preg_match("/wifi/i", $features) && preg_match("/cafe/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"podium\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/wifi/i", $features) && !preg_match("/cafe/i", $features)  &&  preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon name=\"podium\"></ion-icon>  <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else if(preg_match("/tv/i", $features) && preg_match("/wifi/i", $features) && preg_match("/cafe/i", $features)  && !preg_match("/ac/i", $features)){
                            $feature = "<ion-icon name=\"tv\"></ion-icon> <ion-icon name=\"cafe\"></ion-icon> <ion-icon name=\"battery-charging\"></ion-icon> <ion-icon ios=\"ios-wifi\" md=\"md-wifi\"></ion-icon>";
                        }else{
                            $feature ='<ion-icon name="battery-charging"></ion-icon>';
                        }

                    }else{
                        $feature = '';
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

            print_r((!empty($result) ? $this->encode(array('data'=>$result,'count'=>count($data),'results'=>$results,'default_company'=>$this->company(false,false,false,array_unique($companies)))) : ''));
       }else{
           $this->message = "All fields are required";
       }
   }

    public function company($id = false,$r1 = false,$r2 = false,$company = [])
    {

        $cp =  $company;//$this->get_company(); // TODO: Change the autogenerated stub


        $companies_results = '';

        if(count($cp) > 0) {

            foreach ($cp as $company) {
                $cp_id = $company['id'];
                $cp_name = $company['name'];

                $count_companies = count($cp);

                $companies_results .= " <span class=\"badge badge-secondary\">
								<div class=\"form-check form-check-inline\">
									<input class=\"form-check-input cp_f\" type=\"checkbox\" class='company' value='$cp_id' id=\"inlineCheckbox1\" name=\"option_company\">
									<label class=\"form-check-label\" for=\"inlineCheckbox1\">$cp_name</label>
								</div>
								<span class=\"badge badge-light\">$count_companies</span>
							</span>";
            }
        }


        return $companies_results;
    }


}

new Requests();
