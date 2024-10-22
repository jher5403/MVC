<div class="modal fade" id="login-modal">
	<div class="modal-dialog">
		<div class="modal-content">

			<form id="login-form" method="GET" action="<?=ROOT?>home/login">

				<div class="modal-header">
					<h3>Login</h3>
				</div>

				<div class="modal-body">
					
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" required="">
					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required="">
					</div>

				</div>

				<div class="modal-footer justify-content-center">
					<div class="row justify-content-center">

						<div class="col">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#register-modal">Register</button>
						</div>

						<div class="col">
							<input type="submit" name="submit" value="Login" class="btn btn-primary">
						</div>

					</div>
				</div>
			
			</form>
		</div>
	</div>
</div>
