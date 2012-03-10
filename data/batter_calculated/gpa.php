#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 13; // OBP
$stat2 = 14; // SLG
$new_stat = 41;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$OBP = getValue( $iPlayer, $stat1 ); // OBP 
		if ( $OBP === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$SLG = getValue( $iPlayer, $stat2 );
		if ( $SLG === false )
			throw new Exception( "Can't find stat #".$stat2 );
			
		$GPA = ((1.8*$OBP) + $SLG ) / 4; // GPA
		storeValue( $iPlayer, $new_stat , $GPA );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
