<html>
<head>
	<title>Account: Log in</title>
	<link type="text/css" rel="stylesheet" href="<?=loadStatic("css/normalize.css")?>">
	<link type="text/css" rel="stylesheet" href="<?=loadStatic("css/skeleton.css")?>">
	<link type="text/css" rel="stylesheet" href="<?=loadStatic("css/skeleton.css")?>">
</head>
<body>
<div class="container">
	<div class="three columns" style="border: 1px solid white"></div>
	<div class="six columns" style="align: center">
		<hr>
			<a><h4>Log In</h4></a>
		<hr>
	<?php if(Raise::available()){ ?>
		<div class="twelve columns">
			<p style="color: red"><?=Raise::get('error')?></p>
		</div>
	<?php } ?>
	<div class="row">
		<div class="twelve columns" >
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
				<div class="twelve columns">
					<div class="six columns">
							<input class="button button-primary" type="submit" value="Log in">
					</div>
					<div class="six columns">
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