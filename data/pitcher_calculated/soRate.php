#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 114; // K
$stat2 = 103; // IP
$new_stat = 133;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$KO = getValue( $iPlayer, $stat1 ); // KO  
		if ( $KO === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$IP = getValue( $iPlayer, $stat2 );
		if ( $IP === false )
			throw new Exception( "Can't find stat #".$stat2 );
		if ( $IP == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$Rate = ( $KO / $IP )*9;
		storeValue( $iPlayer, $new_stat , $Rate );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
