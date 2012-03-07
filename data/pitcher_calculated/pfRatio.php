#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 114; // KO
$stat2 = 113; // BB
$stat3 = 103; // IP
$new_stat = 138;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$KO = getValue( $iPlayer, $stat1 ); // KO  
		if ( $KO === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$BB = getValue( $iPlayer, $stat2 );
		if ( $BB === false )
			throw new Exception( "Can't find stat#".$stat2 );
		$IP = getValue( $iPlayer, $stat3 );
		if ( $IP === false )
			throw new Exception( "Can't find stat #".$stat3 );
		if ( $IP == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$Ratio = ( $KO + $BB ) / $IP; // pfRatio
		storeValue( $iPlayer, $new_stat , $Ratio );
	} catch ( Exception $e ) {
	}
}

?>
