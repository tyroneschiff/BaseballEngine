<?
	include 'connect.php';
	include 'functions.php';

	$batters = getBatters();
	$string = implode( '", "', $batters );
	$string = "[\"".$string."\"]";

	echo $string;

?>
