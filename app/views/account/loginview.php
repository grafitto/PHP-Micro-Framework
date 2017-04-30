<html>
<head>
	<title>Account: Log in</title>
	<link type="text/css" rel="stylesheet" href="<?=loadStatic("twitter/bootstrap/dist/css/bootstrap.min.css")?>">
	<link type="text/css" rel="stylesheet" href="<?=loadStatic("twitter/bootstrap/dist/css/bootstrap-theme.min.css")?>">
</head>
<body>
<div class="container">
	<div class="col-md-3" style="border: 1px solid white"></div>
	<div class="col-md-6" style="align: center">
		<hr>
			<a><h4>Log In</h4></a>
		<hr>
	<?php if(Raise::available()){ ?>
		<div class="col-md-12">
			<p style="color: red"><?=Raise::get('error')?></p>
		</div>
	<?php } ?>
	<div class="row">
		<div class="col-md-12" >
			<form action="" method="post">
				<label for="name">Username:</label>
					<input class="u-full-width" type="text" name="username" placeholder="Username" required>
				<label for="password">Password:</label>
					<input class="u-full-width" type="password" name="password" placeholder="Password" required>
				<!--<label for="rank">Login As:</label>
					<select class="u-full-width" name="rank">
						<option value="landlord">Landlord</option>
						<option value="tenant">Tenant</option>
					</select> -->
				<div class="col-md-12">
					<div class="col-md-6">
							<input class="btn btn-primary" type="submit" value="Log in">
					</div>
					<div class="col-md-6">
						<p>Need an account? <a href="signup">Sign Up</a></p>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>
</div>
</body>
</html>