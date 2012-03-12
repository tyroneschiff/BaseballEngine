<html>
	<head>
		<!-- Bootstrap Styling -->
		<link rel="stylesheet" href="/bootstrap/docs/assets/css/bootstrap.css">
		<link rel="stylesheet" href="/bootstrap/docs/assets/css/bootstrap-responsive.css">
		<link rel="stylesheet" href="/bootstrap/docs/assets/css/docs.css">
		<link rel="stylesheet" href="/bootstrap/docs/assets/js/google-code-prettify/prettify.css">
		<link href='https://fonts.googleapis.com/css?family=Acme|Ubuntu' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link href="/images/favicon.ico" rel="icon" type="image/x-icon" />

		<!-- Page Specific Styling -->
		<link rel="stylesheet" href="/login/css/style.css">
		<title>The Baseball Engine - Login</title>
	</head>
<body>
	<div class="modal" id="login">
		<div class="modal-header">
			<a href="/"><h3>The Baseball Engine</h3></a>
		</div>
		<div class="modal-body">
			<?
        if ( array_key_exists( 'e', $_GET ) ) echo "
        <div class='alert alert-error'>
          <span>E-mail address and/or password were not found. Please try again.</span>
        </div>";
				if ( array_key_exists( 'd', $_GET ) ) echo "
        <div class='alert alert-info'>
          <span>That e-mail address has already been registered. Please log in or reset password.</span>
        </div>";
        if ( array_key_exists( 'c', $_GET ) ) echo "
        <div class='alert alert-success'>
          <span>A password reset e-mail has been sent. Please check your e-mail.</span>
        </div>";
      ?>
			<div class="well"><!-- Begin well -->
				<form action="checkLogin.php" method="post">
					<label>E-mail Address</label>
					<input type="text" name="email" autofocus/>
					<? if ( array_key_exists( 'e', $_GET ) ) echo "<i class='icon-exclamation-sign'></i>"; ?>
					<label>Password</label>
					<input type="password" name="passwordPro" />
					<? if ( array_key_exists( 'e', $_GET ) ) echo "<i class='icon-exclamation-sign'></i>"; ?>
			</div>
		</div>
		<div class="modal-footer">
			<a class="forgot">Forgot Password</a>
			<button type="submit" class="btn btn-inverse">Log In</button>
		</form>
		</div>
	</div>

	<div class="modal" id="forgot" style="display:none;">
		<div class="modal-header">
			<h3>The Baseball Engine</h3>
		</div>
		<div class="modal-body">
			<div class="well"><!-- Begin well -->
				<form action="/login/forgotPassword.php" method="post">
					<label>E-mail Address</label>
					<input type="text" name="email" class="forgot-password" autofocus/>
			</div>
		</div>
		<div class="modal-footer">
			<a class="login">Log In</a>
			<button type="submit" class="btn btn-inverse">Send Reset Password E-mail</button>
				</form>
		</div>
	</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="/bootstrap/docs/assets/js/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="/bootstrap/docs/assets/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="/login/js/script.js"></script>
</body>
</html>
