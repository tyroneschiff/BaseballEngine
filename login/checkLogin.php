<?
	session_start();
	$email = $_POST["email"];
	$password = $_POST["passwordPro"];

	include "/home/tyrone/baseballengine1.2/connect.php";
	include "/home/tyrone/baseballengine1.2/functions.php";

	$password = truehash($password);

	$sql = sprintf( "SELECT * FROM members WHERE email = '%s' AND password = '%s'", $email, $password );
	$res = mysql_query( $sql );

	$count = mysql_num_rows( $res );
	if ( $count == 1 ){
		$_SESSION["email"] = $email;
		$_SESSION["loggedIn"] = true;
		header( "Location:/pro/" );
	} else {
		header("Location:/login/?e");
	}
?>
