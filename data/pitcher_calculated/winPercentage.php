#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 104; // Wins
$stat2 = 105; // Losses
$new_stat = 140;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$Wins = getValue( $iPlayer, $stat1 ); // KO  
		if ( $Wins === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$Losses = getValue( $iPlayer, $stat2 );
		if ( $Losses === false )
			throw new Exception( "Can't find stat #".$stat2 );
		if ( ($Wins + $Losses) == 0 )
			throw new Exception( "Can't divide by zero <br/ >" );
			
		$WinP = $Wins / ($Wins + $Losses); 
		storeValue( $iPlayer, $new_stat , $WinP );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
