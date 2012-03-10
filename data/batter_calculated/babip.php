#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 2; // ABs
$stat2 = 7; // HRs
$stat3 = 4; // Hits
$stat4 = 12; // Strike Outs
$stat5 = 20; // Sac Fly
$new_stat = 40;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		
		$AB = getValue( $iPlayer, $stat1 ); // at bats
		if ( $AB === false )
			throw new Exception( "Can't find stat #".$stat1 );

		$Hits = getValue( $iPlayer, $stat3 ); // hits
		if ( $Hits === false )
			throw new Exception( "Can't find stat #".$stat3 );

		$HR = getValue( $iPlayer, $stat2 ); // HRS
		if ( $HR === false )
			throw new Exception( "Can't find stat #".$stat2 );

		$SO = getValue( $iPlayer, $stat4 ); // SO
		if ( $SO === false )
			throw new Exception ( "Can't find stat #".$stat4 );

		$SF = getValue( $iPlayer, $stat5 ); // SF
		if ( $SF === false )
			throw new Exception( "Can't find stat #".$stat5 );

		if ( ($AB - $SO - $HR + $SF) == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
		
		$BABIP = ($Hits - $HR)/($AB - $SO - $HR + $SF);
		storeValue( $iPlayer, $new_stat , $BABIP );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
