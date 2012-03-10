<?
	$email = mysql_real_escape_string( strip_tags( $_POST["email"] ));

	include "/home/tyrone/baseballengine1.2/connect.php";

	function getPassword( $email ){
		$sql = sprintf( "SELECT password FROM members WHERE email = '%s'", $email );
		$res = mysql_query( $sql );
		$arr = mysql_fetch_array( $res );
		return $arr['password'];
	}

	$password = getPassword( $email );

	$sql = sprintf( "SELECT email FROM members WHERE email = '%s'", $email );
	$res = mysql_query( $sql );
	$count = mysql_num_rows( $res );

	if ( $count == 1 ){
		$to = $email;
		$subject = "Forgot Password E-mail";
		$message = "
		<body>
			<p>Hi,</p>
			<p>To reset your password, please click the following link: <a href='https://baseballengine.com/login/create-password/?p=$password'>https://baseballengine.com/login/create-password/?p=$password</a></p>
			<p>Thank you for using The Baseball Engine.</p>
		</body>";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: forgot-password <forgot-password@baseballengine.com>';

		mail( $to, $subject, $message, $headers );
	} else {
		header("Location:/login/?e");
	}
?>
