#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 11; // Walks
$stat2 = 12; // Ks
$new_stat = 44;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$BB = getValue( $iPlayer, $stat1 ); // BB 
		if ( $BB === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$K = getValue( $iPlayer, $stat2 );
		if ( $K === false )
			throw new Exception( "Can't find stat #".$stat2 );
		if ( $K == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$BBK = $BB / $K; 
		storeValue( $iPlayer, $new_stat , $BBK );
	} catch ( Exception $e ) {
	}
}

?>
