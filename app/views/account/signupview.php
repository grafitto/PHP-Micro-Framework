<html>
<head>
	<title>Account: Log in</title>
		<link type="text/css" rel="stylesheet" href="<?=loadStatic("css/normalize.css")?>">
		<link type="text/css" rel="stylesheet" href="<?=loadStatic("css/skeleton.css")?>">
</head>
<body>
<div class="container">
	<div class="one columns" style="border: 1px solid white"></div>
	<div class="nine columns">
		<hr>
			<a><h4>Sign Up</h4></a>
		<hr>
	<div class="row">
		<div class="twelve columns" >
			<form action="" method="post">
			<div class="six columns">
				<label for="name">Full Name</label>
					<input class="u-full-width" type="text" name="fullname" placeholder="Fullname" required>
			</div>
			<div class="six columns">
				<label for="name">National ID:</label>
					<input class="u-full-width" type="text" name="nationalid" placeholder="Natinal ID" required>
			</div>
				<label for="phonenumber">Phone number:</label>
					<input class="u-full-width" type="text" name="phonenumber" placeholder="Phone number" required>
				<a>Account Details:</a>
				<label for="username">Username:</label>
					<input class="u-full-width" type="text" name="username" placeholder="Username" required>
				<label for="email">Email:</label>
					<input class="u-full-width" type="email" name="email" placeholder="Email eg email@domain.com" required>
			<div class="twelve columns">
				<div class="six columns">
					<label for="password">Password:</label>
						<input class="u-full-width" type="password" name="password" placeholder="Password" required>
				</div>
				<div class="six columns">
					<label for="rewrite_password">Confirm Password:</label>
						<input class="u-full-width" type="password" name="rewrite_password" placeholder="Confirm Password" required>
				</div>
			</div>
	
				<div class="twelve columns">
					<div class="eight columns">
						<input class="button button-primary" type="submit" value="Create">
					</div>
					<div class="four columns">
						<p>Have an account? <a href="login">Log In</a></p>
					</div>
				</div>
			</form>
		</div>
	</div>
	</div>
</div>
</body>
</html>