<?
	include 'connect.php';	
	include 'functions.php';

	$statistic = $_GET['statistic'];
	$type = $_GET['type'];

	$statistic_id = getStatisticIdFromStatistic( $statistic, $type );

	$players = getPlayersBasedOnStatistic( $statistic_id );

	echo json_encode( $players );
?>
