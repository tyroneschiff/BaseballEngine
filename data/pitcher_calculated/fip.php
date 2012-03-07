#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 114; // K
$stat2 = 103; // IP
$stat3 = 110; // HR
$stat4 = 113; // BB
$new_stat = 136;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$KO = getValue( $iPlayer, $stat1 ); // KO  
		if ( $KO === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$HR = getValue( $iPlayer, $stat3 );
		if ( $HR === false )
			throw new Exception( "Can't find stat#".$stat3 );
		$BB = getValue( $iPlayer, $stat4 );
		if ( $BB === false )
			throw new Exception( "Can't find stat#".$stat4 );

		$IP = getValue( $iPlayer, $stat2 );
		if ( $IP === false )
			throw new Exception( "Can't find stat #".$stat2 );
		if ( $IP == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$FIP = ((13*$HR)+(3*$BB)-(2*$KO))/$IP; // At Bats per ...
		storeValue( $iPlayer, $new_stat , $FIP );
	} catch ( Exception $e ) {
	}
}

?>
