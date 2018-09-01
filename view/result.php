<?php if(!isset($_GET['date']) || !isset($_GET['from']) || !isset($_GET['to'])|| empty($_GET['from']) || empty($_GET['to']) || empty($_GET['date'])) {
  echo "<script>window.location.href = '$url';</script>"; };

$default_date = preg_replace('#[^0-9-]#','',$_GET['date']);
$default_from = preg_replace('#[^0-9]#','',$_GET['from']);
$default_to = preg_replace('#[^0-9]#','',$_GET['to']);


$default_froms = @$locations->getLocations("id='$default_from'")[0];
$default_from_name = @$default_froms['name'];
$default_from_id = @$default_froms['id'];
$default_tos = @$locations->getLocations("id='$default_to'")[0];
$default_to_name = @$default_tos['name'];
$default_to_id = $default_tos['id'];

if($default_to === $default_to_id)
{
    $default_to = "<option value='$default_to_id' selected>$default_to_name</option>";
}
if($default_from === $default_from_id)
{
    $default_from = "<option value='$default_from_id' selected>$default_from_name</option>";
}
?>

<div class="container-fluid res">
	<div class="container">
		<div class="row">
			<div class="col-lg-2">
				<div class="sidebar">

					<select class="custom-select mb-2 sorts" id="inputGroupSelect01">
    <option value="">Sort by</option>
    <option value="1">Alphabetical</option>
    <option value="2">Price</option>
    <option value="3">Time</option>
    <option value="3">Seats Available</option>
  </select>
					<div class="filters">
						<h5>FILTERS</h5>
						<div class="filter-border-root mb-2"></div>
						<div class="filters-0">
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" value="tv" class="custom-control-input checks" id="customCheck1">
								<label class="custom-control-label" for="customCheck1">TV</label>
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" value="ac" class="custom-control-input checks" id="customCheck2">
								<label class="custom-control-label" for="customCheck2">AC</label>
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" value="charge" class="custom-control-input  checks" id="customCheck3">
								<label class="custom-control-label" for="customCheck3">CHARGE</label>
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" value="drinks" class="custom-control-input checks" id="customCheck4">
								<label class="custom-control-label" for="customCheck4">DRINKS</label>
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" value="toilet" class="custom-control-input  checks" id="customCheck5">
								<label class="custom-control-label" for="customCheck5">TOILET</label>
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" value="wifi" class="custom-control-input checks" id="customCheck6">
								<label class="custom-control-label" for="customCheck6">WI-FI</label>
							</div>
							<div class="custom-control custom-checkbox mb-2">
								<input type="checkbox" value="" class="custom-control-input both" id="customCheck7">
								<label class="custom-control-label" for="customCheck7">BOTH</label>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-lg-10">
                <?php include_once (__DIR__.'/filter.php');?>

				<div class="result">
<!--                    result from the server holder-->
                </div>
			</div>
		</div>
	</div>
</div>
