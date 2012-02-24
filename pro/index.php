<?
	session_start();
	if (!$_SESSION['loggedIn']){
		header("Location:/");
	} else {
	?>
<html>
<body>
	<?
		$currentUser = $_SESSION['username'];
		echo $currentUser;
	}
	?>
	<p>Good job! You got it working!!</p>
	<a href="logout.php">Logout</a>
</body>
</html>
