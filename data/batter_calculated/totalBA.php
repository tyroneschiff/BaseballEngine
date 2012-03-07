#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 2;  // ABs
$stat2 = 18; // TB
$stat3 = 9; // SB
$stat4 = 11; // BB
$stat5 = 10; // CS
$stat6 = 4; // Hits
$stat7 = 21; // GIDP

$new_stat = 47;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$AB = getValue( $iPlayer, $stat1 ); // at bats    
		if ( $AB === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$TB = getValue( $iPlayer, $stat2 );
		if ( $TB === false )
			throw new Exception( "Can't find stat #".$stat2 );
		$SB = getValue( $iPlayer, $stat3 );
		if ( $SB === false )
			throw new Exception( "Can't find stat#".$stat3 );
		$BB = getValue( $iPlayer, $stat4 );
		if ( $BB === false )
			throw new Exception( "Can't find stat#".$stat4 );
		$CS = getValue( $iPlayer, $stat5 );
		if ( $CS === false )
			throw new Exception( "Can't find stat#".$stat5 );
		$Hits = getValue( $iPlayer, $stat6 );
		if ( $Hits === false )
			throw new Exception( "Can't find stat#".$stat6 );
		$GIDP = getValue( $iPlayer, $stat7 );
		if ( $GIDP === false )
			throw new Exception( "Can't find stat#".$stat7 );

		if ( ($AB - $Hits + $CS + $GIDP) == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$TBA = (($TB + $SB + $BB - $CS) / ($AB - $Hits + $CS + $GIDP)); // TBA
		storeValue( $iPlayer, $new_stat , $TBA );
	} catch ( Exception $e ) {
	}
}

?>
