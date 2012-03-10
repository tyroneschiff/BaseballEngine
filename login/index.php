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
		<style>
			.modal {
				left:58%;
				width:360px;
			}
			div.modal-header h3 {
				text-align:center;
				font-family: 'Acme', sans-serif;
				font-size:24px;
			}
			div.well {
				margin-bottom:0;
			}
			div.well form {
				margin:0;
			}
			div.well label {
				font-weight:bold;
			}
			div.well input {
				height:27px;
				width:260px;
			}
			div.well i.icon-exclamation-sign {
				color:red;
				position:relative;
				top:-4px;
				left:5px;
			}
			div.modal-footer a.forgot, div.modal-footer a.login {
				float:left;
				padding:5px;
				cursor:pointer;
			}
			div.modal-footer a.forgot:hover, div.modal-footer a.login:hover {
				text-decoration:underline;
			}
		</style>
		<title>The Baseball Engine - Login</title>
	</head>
<body>
	<div class="modal" id="login">
		<div class="modal-header">
			<h3>The Baseball Engine</h3>
		</div>
		<div class="modal-body">
			<div class="well"><!-- Begin well -->
				<form action="checkLogin.php" method="post">
					<label>E-mail Address</label>
					<input type="text" name="email" autofocus/>
					<? if ( array_key_exists( 'e', $_GET ) ) echo "<i class='icon-exclamation-sign'></i>"; ?>
					<label>Password</label>
					<input type="password" name="passwordPro" />
					<? if ( array_key_exists( 'e', $_GET ) ) echo "<i class='icon-exclamation-sign'></i>"; ?>
			</div>
			<? 
				if ( array_key_exists( 'e', $_GET ) ) echo "
				<div style='margin-top:10px;text-align:center;font-size:11px;'>
					<span style='color:red;margin-top:20px;'>Email address and password were not found. Please try again.</span>
				</div>";
			?>
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
				<label>E-mail Address</label>
				<input type="text" name="email" class="forgot-password" autofocus/>
			</div>
		</div>
		<div class="modal-footer">
			<a class="login">Log In</a>
			<button type="submit" class="btn btn-inverse">Send Forgot Password E-mail</button>
		</div>
	</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="/bootstrap/docs/assets/js/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="/bootstrap/docs/assets/js/bootstrap-modal.js"></script>
<script>
	$('#login').modal({
		show: true,
		backdrop: 'static',
		keyboard: false
	});

	$('.forgot').on('click',function(){
		$('#login').hide();
		$('#forgot').show();
	});

	$('.login').on('click',function(){
		$('#login').show();
		$('#forgot').hide();
	});
</script>
</body>
</html>
