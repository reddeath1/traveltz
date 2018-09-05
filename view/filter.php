<?php
/**
 * Created by PhpStorm.
 * User: FrankGalos
 * Date: 8/28/2018
 * Time: 2:00 PM
 */

echo 'Loc '.$location_names;


?>

<div class="container">
	<form method="GET" action="<?php echo $url;?>/result/" autocomplete="off">
		<div class="form-row">
			<div class="input-group form-group input-group-lg col-md">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
						<ion-icon name="calendar"></ion-icon>
					</span>
				</div>
				<input type="date" class="form-control" name='date' placeholder="Date" id="date-picker" value="<?php echo $default_date;?>">
			</div>
			<div class="form-group input-group-lg col-md">
				<select class="form-control" id="from" value="<?php echo $default_from;?>" name="from">
					<option value="">From</option>
					<?php echo $default_from;?>
					<?php echo $location_names;?>
				</select>
			</div>
			<div class="swap">
				<ion-icon name="swap"></ion-icon>
			</div>
			<div class="form-group input-group-lg col-md">
				<select class="form-control" name="to" id="to">
					<option value="">To</option>
					<?php echo $default_to;?>
					<?php echo $location_names;?>
				</select>
			</div>
		</div>
	</form>
</div>
