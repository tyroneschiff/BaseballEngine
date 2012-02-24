<?
	session_start();
	$username = $_POST["username"];
	$password = $_POST["password"];

	include '../connect.php';

	$sql = sprintf( "SELECT * FROM members WHERE email = '%s' AND password = '%s'", $username, $password );
	$res = mysql_query( $sql );

	$count = mysql_num_rows( $res );
	if ( $count == 1 ){
		$_SESSION["username"] = $username;
		$_SESSION["loggedIn"] = true;
		header( "Location:/pro/" );
	} else {
		header("Location:/");
	}
?>
