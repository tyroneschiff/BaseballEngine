#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 112; // ERA
$stat2 = 103; // IP
$new_stat = 137;

$avgERA = getAverageLeagueData( 112 );

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$ERA = getValue( $iPlayer, $stat1 ); // KO  
		if ( $ERA === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$IP = getValue( $iPlayer, $stat2 );
		if ( $IP === false )
			throw new Exception( "Can't find stat #".$stat2 );
			
		$PR = ( $avgERA - $ERA ) * ( $IP / 9 ); // PR
		storeValue( $iPlayer, $new_stat , $PR );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
