<?
	include 'connect.php';
	include 'functions.php';
	
	$batters = getBEScoreBatters();
	$string = implode( '", "', $batters );
	$string = "[\"".$string."\"]";
	
	echo $string;
?>
