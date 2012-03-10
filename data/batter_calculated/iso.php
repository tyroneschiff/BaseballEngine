#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 2; // AB
$stat2 = 7; // HRs
$stat3 = 5; // Doubles
$stat4 = 6; // Triples
$new_stat = 42;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$AB = getValue( $iPlayer, $stat1 ); // at bats    
		if ( $AB === false )
			throw new Exception( "Can't find stat #".$stat1 );

		$HR = getValue( $iPlayer, $stat2 );
		if ( $Doubles === false )
			throw new Exception( "Can't find stat #".$stat2 );

		$Doubles = getValue( $iPlayer, $stat3 );
    if ( $Triples === false )
      throw new Exception( "Can't find stat #".$stat3 );

		$Triples = getValue( $iPlayer, $stat4 );
    if ( $Triples === false )
      throw new Exception( "Can't find stat #".$stat4 );

		if ( $AB == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$ISO = ($Doubles + ( $Triples*2 ) + ( $HR*3 )) / $AB; // ISO
		storeValue( $iPlayer, $new_stat , $ISO );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
