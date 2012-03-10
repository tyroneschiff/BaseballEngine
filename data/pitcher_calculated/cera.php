#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 108; // Hits
$stat2 = 113; // BB
$stat3 = 122; // TBF
$stat4 = 103; // IP
$stat5 = 110; // HR

$new_stat = 139;

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$Hits = getValue( $iPlayer, $stat1 ); // KO  
		if ( $Hits === false )
			throw new Exception( "Can't find stat #".$stat1 );
		$BB = getValue( $iPlayer, $stat2 );
		if ( $BB === false )
			throw new Exception( "Can't find stat #".$stat2 );
		$TBF = getValue( $iPlayer, $stat3 );
		if ( $TBF === false )
			throw new Exception( "Can't find stat#".$stat3 );
		$IP = getValue( $iPlayer, $stat4 );
		if ( $IP === false )
			throw new Exception( "Can't find stat#".$stat4 );
		$HR = getValue( $iPlayer, $stat5 );
		if ( $HR === false )
			throw new Exception( "Can't find stat#".$stat5 );

		$PTB = 0.89*(1.255*( $Hits - $HR ) + 4*$HR ) + 0.56*( $BB );

		$ERC = ((( $Hits + $BB )*$PTB)/( $TBF * $IP ))*9 - 0.56; // ERC
		storeValue( $iPlayer, $new_stat , $ERC );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
