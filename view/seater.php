<?php

if(!empty($q)){
    $dir = str_replace('view','controller/Bus.php',__DIR__);

    include_once ($dir);

$buss = new Bus();
  $bus = $buss->getBuses($q);

$b_summary = "";
$seat_count = '';
$seatNo = 0;
  if(count($bus) > 0){
      foreach ($bus as $item){
          $seatNo = $item['seats_count'];
          $sid = $item['id'];
          $time = $item['d_time'];
          $dates = $item['dep_date'];
          $route = $item['route'];
          $bno = $item['bus_no'];
          $logo = $item['logo'];

          $date = date("m D Y",strtotime($dates));
          $e_time = date("M d, Y H:i:s",strtotime($dates));
          $time = date('H:i A',strtotime($time));

          $elapse = $buss->Elapsed($dates);

          $b_summary = "<div class=\"card-header\">
						summary
						<span class=\"float-right collapse-btn\" data-toggle=\"collapse\" data-target=\"#collapsible-summary\">
							<ion-icon name=\"menu\"></ion-icon>
						</span>
					</div>
					<div class=\"card-body collapse\" id=\"collapsible-summary\">
						<img src=\"$url/view/public/images/busLogo/$logo\" class=\"rounded img-fluid\" alt=\"...\"> DAR - ARS

						<p><strong>Date: </strong>$date</p>
						<p><strong>Time of Departure: </strong>$time</p>
						<p><strong>ETA: </strong><i class='elapsed' time='$e_time'>$elapse</i></p>
						<p><strong>Bus No.: </strong>$bno</p>
					</div>";
      }
  }

  $seats = $buss->getSeats($q,$seatNo);

  if(count($seats) > 0){
      foreach ($seats as $seat) {
          $sid = $seat['seat_id'];
          $sno = $seat['sno'];
          $cost = $seat['cost'];
          $seat_count .="<div class=\"col-xs bus-seat\" seat-data='$cost,$sno,$sid'><img src=\"$url/view/public/images/icons/seat-available.png\" ></div>";
      }
      $seat_count .="<div class=\"col-xs bus-seat\"><img src=\"$url/view/public/images/icons/seat-available.png\" ></div>";
  }
}
?>


<div class="container-fluid seater">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="seat-layout-bg">
					<div class="seat-layout">
						<div class="row mb-2 seats">

							<?php echo $seat_count; ?>
						</div>

<!--						<div class="row mb-2 mt-2 mid-seat">-->
<!--							<div class="col-xs"><img src="--><?php //echo $url;?><!--/view/public/images/icons/seat-available.png"></div>-->
<!--						</div>-->
<!---->
<!--						<div class="row mb-2">-->
<!--						<div class="col-xs"><img src="--><?php //echo $url;?><!--/view/public/images/icons/seat-unavailable.png" id="" onclick="changeImg()"></div>-->
<!--						</div>-->
					</div>
					<script>
						var image = document.getElementById("seatImg");

						function changeImg() {
							if (image.getAttribute('src') == "<?php echo $url;?>/view/public/images/icons/seat-available.png") {
								image.src = "<?php echo $url;?>/view/public/images/icons/seat-selected.png";
							} else {
								image.src = "<?php echo $url;?>/view/public/images/icons/seat-available.png";
							}
						}

					</script>
					<form>
						<div class="form-row">
							<div class="form-group input-group-md col-md-5">
								<select class="form-control">
									<option>Boarding point</option>
								</select>
							</div>
							<div class="form-group input-group-md col-md-5">
								<select class="form-control">
									<option>Dropping point</option>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="seat-keys mt-2 mb-2">
					<div class="container">
						<div class="row">
							<div class="col-md">
								<img src="<?php echo $url;?>/view/public/images/icons/seat-booked.png"> Booked
							</div>
							<div class="col-md">
								<img src="<?php echo $url;?>/view/public/images/icons/seat-available.png"> Available
							</div>
							<div class="col-md">
								<img src="<?php echo $url;?>/view/public/images/icons/seat-unavailable.png"> Unavailable
							</div>
							<div class="col-md">
								<img src="<?php echo $url;?>/view/public/images/icons/seat-selected.png"> Selected
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 offset-lg-1 summary">
				<div class="card">
					<?php echo  $b_summary;?>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><strong>SUMMARY:</strong>
							<ul class="subtotal-0">
                                <p><strong>Seat(s) selected <b class="selected-seat" style="font-weight: normal;"></b>: </strong><b style="font-weight: normal;" class="seat-no"></b></p>
                                <p><strong>Price Each:</strong> <b style="font-weight: normal;" class="price"></b></p>
							</ul>
						</li>
						<li class="list-group-item"><strong>TOTAL</strong>: <span class="float-right"><strong class="total-price"></strong></span></li>
					</ul>
				</div>
				<a href="<?php echo $url;?>/personaldetails/" class="btn btn-banner btn-block mt-2">NEXT</a>
			</div>
		</div>
	</div>
</div>
