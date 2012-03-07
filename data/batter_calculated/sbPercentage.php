#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 9; // SB
$stat2 = 10; // CS
$new_stat = 38;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$SB = getValue( $iPlayer, $stat1 ); // at bats    
		if ( $SB === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$CS = getValue( $iPlayer, $stat2 );
		if ( $CS === false )
			throw new Exception( "Can't find stat #".$stat2 );
		if ( $CS == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$SBpercent = (( $SB / ( $SB + $CS )) * 100 ); // SB Percent
		storeValue( $iPlayer, $new_stat , $SBpercent );
	} catch ( Exception $e ) {
	}
}

?>
