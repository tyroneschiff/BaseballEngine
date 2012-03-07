#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 108; // Hits
$stat2 = 122; // TBF
$stat3 = 113; // Walks
$new_stat = 134;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$Hits = getValue( $iPlayer, $stat1 ); // Hits
		if ( $Hits === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$TBF = getValue( $iPlayer, $stat2 );
		if ( $TBF === false )
			throw new Exception( "Can't find stat #".$stat2 );
		$BB = getValue( $iPlayer, $stat3 );
		if ( $BB === false )
			throw new Exception( "Can't find stat #".$stat3 );

		if ( ($TBF - $BB) == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$BAA = $Hits / ( $TBF - $BB ); // At Bats per ...
		storeValue( $iPlayer, $new_stat , $BAA );
	} catch ( Exception $e ) {
	}
}

?>
