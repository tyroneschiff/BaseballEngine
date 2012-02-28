<?
	include 'connect.php';
	include 'functions.php';
	
	$pitchers = getBEScorePitchers();
	$string = implode( '", "', $pitchers );
	$string = "[\"".$string."\"]";
	
	echo $string;
?>
