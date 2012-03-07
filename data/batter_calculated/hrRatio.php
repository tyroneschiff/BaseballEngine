#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 2;
$stat2 = 7; // HRs
$new_stat = 29;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$AtBats = getValue( $iPlayer, $stat1 ); // at bats    
		if ( $AtBats === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$Statistic = getValue( $iPlayer, $stat2 );
		if ( $Statistic === false )
			throw new Exception( "Can't find stat #".$stat2 );
		if ( $Statistic == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$Ratio = $AtBats / $Statistic; // At Bats per ...
		storeValue( $iPlayer, $new_stat , $Ratio );
	} catch ( Exception $e ) {
	}
}

?>
