<div class="container-fluid res">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<form>
					<div class="form-row align-items-center">
						<div class="col-sm">
							<label class="sr-only" for="inlineFormInputGroup">First Name</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">27</div>
								</div>
								<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="First Name">
							</div>
						</div>
						<div class="col-sm">
							<label class="sr-only" for="inlineFormInput">Last Name</label>
							<input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Last Name">
						</div>
						<div class="col-sm">
							<label class="sr-only" for="inlineFormInput">Phone Number</label>
							<input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Phone Number">
						</div>
						<div class="col-sm">
							<label class="sr-only" for="inlineFormInput">Email</label>
							<input type="email" class="form-control mb-2" id="inlineFormInput" placeholder="Email">
						</div>
						<div class="col-sm">
							<select class="custom-select mb-2" id="inputGroupSelect02">
    							<option selected>Boarding Point</option>
  							</select>
						</div>
					</div>

					<!--					DUPLICATE OF THE FORM-->

					<div class="form-row align-items-center">
						<div class="col-sm">
							<label class="sr-only" for="inlineFormInputGroup">First Name</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">27</div>
								</div>
								<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="First Name">
							</div>
						</div>
						<div class="col-sm">
							<label class="sr-only" for="inlineFormInput">Last Name</label>
							<input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Last Name">
						</div>
						<div class="col-sm">
							<label class="sr-only" for="inlineFormInput">Phone Number</label>
							<input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Phone Number">
						</div>
						<div class="col-sm">
							<label class="sr-only" for="inlineFormInput">Email</label>
							<input type="email" class="form-control mb-2" id="inlineFormInput" placeholder="Email">
						</div>
						<div class="col-sm">
							<select class="custom-select mb-2" id="inputGroupSelect02">
    							<option selected>Boarding Point</option>
  							</select>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-10 offset-sm-1 text-right">
				<button type="button" class="btn btn-banner" data-toggle="modal" data-target=".bd-example-modal-sm">NEXT</button>
				<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalCenterTitle">login</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-label-group">
										<input type="text" id="inputEmail" class="form-control mb-2" placeholder="Email/Phone" required autofocus>
									</div>
									<div class="form-label-group">
										<input type="password" id="inputPassword" class="form-control mb-2" placeholder="Password" required>
									</div>
									<button class="btn btn-banner btn-block mb-2" type="submit">LOGIN</button>
									<div class="mb-0">
										<a href="#">Forgot Password?</a>
									</div>
									<div class="mb-2">
										<a href="<?php echo $url;?>/signup/">I don't have an account.</a>
										<hr>
									</div>
								</form>
								<div class="comtainer">
									<div class="row">
										<div class="col-sm">
											Or login with:
										</div>
										<div class="col-sm">
											<a href="https://www.instagram.com/">
												<ion-icon class="logo-instagram" name="logo-instagram"></ion-icon>
											</a>
											<a href="https://twitter.com/">
												<ion-icon class="logo-twitter" name="logo-twitter"></ion-icon>
											</a>
											<a href="https://www.facebook.com/">
												<ion-icon class="logo-facebook" name="logo-facebook"></ion-icon>
											</a>
											<a href="https://www.facebook.com/">
												<ion-icon class="logo-googleplus" name="logo-googleplus"></ion-icon>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
