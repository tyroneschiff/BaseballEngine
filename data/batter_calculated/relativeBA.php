#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 4; // Hits
$stat2 = 2; // ABs

$avgHits = getAverageLeagueData( 4 );
$avgABs = getAverageLeagueData( 2 );

$new_stat = 46;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$Hits = getValue( $iPlayer, $stat1 );   
		if ( $Hits === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$AB = getValue( $iPlayer, $stat2 );
		if ( $AB === false )
			throw new Exception( "Can't find stat #".$stat2 );

		if ( (( $avgHits - $Hits ) / ( $avgABs - $AB )) == 0 )
			throw new Exception( "Can't divide by zero" );
		if ( ( $avgABs - $AB ) == 0 )
			throw new Exception( "Can't divide by zero" );
		if ( $AB == 0 )
			throw new Exception( "Can't divide by zero" );

		$RBA = (($Hits / $AB) / (( $avgHits - $Hits ) / ( $avgABs - $AB ))); // RBA
		storeValue( $iPlayer, $new_stat , $RBA );
	} catch ( Exception $e ) {
	}
}

?>
