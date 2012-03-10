#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 2; // ABs
$stat2 = 4; // Hits
$stat3 = 19; // SH
$stat4 = 20; // SF
$stat5 = 10; // CS
$stat6 = 39; // RC
$new_stat = 43;

$leagueABS = getSumLeagueData( 2 );
$leagueHits = getSumLeagueData( 4 );
$leagueSH = getSumLeagueData( 19 );
$leagueSF = getSumLeagueData( 20 );
$leagueCS = getSumLeagueData( 10 );
$leagueRuns = getSumLeagueData( 3 );

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$AB = getValue( $iPlayer, $stat1 ); // at bats    
		if ( $AB === false )
			throw new Exception( "Can't find stat #".$stat1 );

		$Hits = getValue( $iPlayer, $stat2 ); // Hits
		if ( $Hits === false )
			throw new Exception( "Can't find stat#".$stat2 );

		$SH = getValue( $iPlayer, $stat3 ); // SH
		if ( $SH === false )
			throw new Exception( "Can't find stat#".$stat3 );

		$SF = getValue( $iPlayer, $stat4 ); // SF
		if ( $SF === false )
			throw new Exception( "Can't find stat#".$stat4 );

		$CS = getValue( $iPlayer, $stat5 ); // CS
		if ( $CS === false )
			throw new Exception( "Can't find stat#".$stat5 );

		$RC = getValue( $iPlayer, $stat6 ); // RC
		if ( $RC === false )
			throw new Exception( "Can't find stat#".$stat6 );

		$LeagueOuts = $leagueABS - ( $leagueHits + $leagueSH + $leagueSF + $leagueCS );
		$RunsperLeagueOuts = ( $leagueRuns / $LeagueOuts );
		$PlayerOuts = $AB - ( $Hits + $SH + $SF + $CS );

		$Vorp = $RC - ( $RunsperLeagueOuts * $PlayerOuts )*0.8; // Vorp
		storeValue( $iPlayer, $new_stat , $Vorp );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
