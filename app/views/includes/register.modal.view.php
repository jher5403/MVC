<!--
 VVV Registration Modal VVV 

 References the new-register.php.
 -->
 <div class="modal fade" id="register-modal">
	<div class="modal-dialog">
		<div class="modal-content">

			<form id="register-form" method="POST">

				<div class="modal-header">
					<h3>Register</h3>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" value="jo@example.com" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Retype Password</label>
						<input type="password" name="retype-password" class="form-control" required>
						<div class="invalid-feedback">
                        	Passwords do not match
						</div>
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="first_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="last_name" class="form-control" required>
					</div>
				</div>

				<div class="modal-footer justify-content-center">
					<div class="row justify-content-center">
						<div class="col">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#login-modal">Back to Login</button>
						</div>
						<div class="col">
                            <button type="submit" class="btn btn-primary">Create Account</button>
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>