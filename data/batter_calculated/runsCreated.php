#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 2; // AB
$stat2 = 4; // Hits
$stat3 = 11; // BB
$stat4 = 10; // CS
$stat5 = 23; // HBP
$stat6 = 21; // GIDP
$stat7 = 18; // TB
$stat8 = 24; // IBB
$stat9 = 19; // SH
$stat10 = 20; // SF
$stat11 = 9; // SB

$new_stat = 39;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$AB = getValue( $iPlayer, $stat1 ); // at bats    
		if ( $AB === false )
			throw new Exception( "Can't find stat #".$stat1 );

		$Hits = getValue( $iPlayer, $stat2 ); // Hits 
		if ( $Hits === false )
			throw new Exception( "Can't find stat #".$stat2 );

		$BB = getValue( $iPlayer, $stat3 ); // BB
		if ( $BB === false )
			throw new Exception( "Can't find stat #".$stat3 );

		$CS = getValue( $iPlayer, $stat4 ); // CS 
		if ( $CS === false )
			throw new Exception( "Can't find stat #".$stat4 );

		$HBP = getValue( $iPlayer, $stat5 ); // HBP
		if ( $HBP === false )
			throw new Exception( "Can't find stat #".$stat5 );

		$GIDP = getValue( $iPlayer, $stat6 ); // GIDP
			if ( $GIDP === false )
				throw new Exception( "Can't find stat #".$stat6 );

		$TB = getValue( $iPlayer, $stat7 ); // TB   
		if ( $TB === false )
			throw new Exception( "Can't find stat #".$stat7 );

		$IBB = getValue( $iPlayer, $stat8 ); // IBB 
		if ( $IBB === false )
			throw new Exception( "Can't find stat #".$stat8 );

		$SH = getValue( $iPlayer, $stat9 ); // SH
		if ( $SH === false )
			throw new Exception( "Can't find stat #".$stat9);

		$SF = getValue( $iPlayer, $stat10 ); // SF
		if ( $SF === false )
			throw new Exception( "Can't find stat #".$stat10 );

		$SB = getValue( $iPlayer, $stat11 ); // at bats
		if ( $SB === false )
			throw new Exception( "Can't find stat #".$stat11 );

		if ( ( $AB + $BB + $HBP + $SH + $SF ) == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$RC = ($Hits + $BB - $CS + $HBP - $GIDP)*($TB + (0.26*($BB - $IBB + $HBP)) + (0.52*( $SH + $SF + $SB ))) / ( $AB + $BB + $HBP + $SH + $SF );
		storeValue( $iPlayer, $new_stat , $RC );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
