<div class="container-fluid seater">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="seat-layout-bg">
					<div class="seat-layout">
						<?php
					$seat = '<div class="col-xs"><img src="/traveltz/view/public/images/icons/seat-available.png" id="seatImg" onclick="changeImg()"></div>';
					$seatNo = 13;
					$x = 1;
					?>
						<div class="row mb-2">

							<?php

						for($x=0; $x<$seatNo;$x++) {
							echo $seat;
						}

						?>
						</div>
						<div class="row mb-2">
							<?php
						$x = 1;
						for($x=0; $x<$seatNo;$x++) {
							echo $seat;
						}

						?>
						</div>
						<div class="row mb-2 mt-2 mid-seat">
							<div class="col-xs"><img src="/traveltz/view/public/images/icons/seat-available.png"></div>
						</div>
						<div class="row mb-2">
							<?php
						$x = 1;
						for($x=0; $x<$seatNo;$x++) {
							echo $seat;
						}

						?>
						</div>
						<div class="row mb-2">
							<?php
						$x = 1;
						for($x=0; $x<$seatNo;$x++) {
							echo $seat;
						}

						?>
							<div class="col-xs"><img src="/traveltz/view/public/images/icons/seat-available.png" id="seatImg" onclick="changeImg()"></div>
						</div>
					</div>
					<script>
						var image = document.getElementById("seatImg");

						function changeImg() {
							if (image.getAttribute('src') == "/traveltz/view/public/images/icons/seat-available.png") {
								image.src = "/traveltz/view/public/images/icons/seat-selected.png";
							} else {
								image.src = "/traveltz/view/public/images/icons/seat-available.png";
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
								<img src="/traveltz/view/public/images/icons/seat-booked.png"> Booked
							</div>
							<div class="col-md">
								<img src="/traveltz/view/public/images/icons/seat-available.png"> Available
							</div>
							<div class="col-md">
								<img src="/traveltz/view/public/images/icons/seat-unavailable.png"> Unavailable
							</div>
							<div class="col-md">
								<img src="/traveltz/view/public/images/icons/seat-selected.png"> Selected
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 offset-lg-1 summary">
				<div class="card">
					<div class="card-header">
						summary
						<span class="float-right" data-toggle="collapse" data-target="#collapsible-summary">
							<ion-icon name="menu"></ion-icon>
						</span>
					</div>
					<div class="card-body collapse" id="collapsible-summary">
						<img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16558674435%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16558674435%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.421875%22%20y%3D%22104.396875%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="rounded img-fluid" alt="..."> DAR - ARS

						<p><strong>Date: </strong>2 August 2018</p>
						<p><strong>Time of Departure: </strong>15:40Hrs</p>
						<p><strong>ETA: </strong>5Hrs</p>
						<p><strong>Bus No.: </strong>T546 HJJ</p>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><strong>SUMMARY:</strong>
							<ul class="subtotal-0">
								<p><strong>Seat(s) selected (2): </strong>A1, A2</p>
								<p><strong>Price Each:</strong> 35000Tzs</p>
							</ul>
						</li>
						<li class="list-group-item"><strong>TOTAL</strong>: <span class="float-right"><strong>70000Tzs</strong></span></li>
					</ul>
				</div>
				<a href="<?php echo $url;?>/personaldetails/" class="btn btn-banner btn-block mt-2">NEXT</a>
			</div>
		</div>
	</div>
</div>
