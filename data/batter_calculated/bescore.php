#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 3; // Runs
$stat2 = 7; // HRs
$stat3 = 8; // RBIs
$stat4 = 9; // SBs
$stat5 = 14; // SLG
$stat6 = 13; // OBP
$stat7 = 43; // VORP
$stat8 = 2; // ABs

$new_stat = 45;

$avgRuns = getAverageLeagueData( 3 );
$avgHR = getAverageLeagueData( 7 );
$avgRBI = getAverageLeagueData( 8 );
$avgSB = getAverageLeagueData( 9 );
$avgSLG = getAverageLeagueData( 14 );
$avgOBP = getAverageLeagueData( 13 );
$avgVORP = getAverageLeagueData( 43 );

$stdRuns = getStdDevLeagueData( 3 );
$stdHR = getStdDevLeagueData( 7 );
$stdRBI = getStdDevLeagueData( 8 );
$stdSB = getStdDevLeagueData( 9 );
$stdSLG = getStdDevLeagueData( 14 );
$stdOBP = getStdDevLeagueData( 13 );
$stdVORP = getStdDevLeagueData( 43 );

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$Runs = getValue( $iPlayer, $stat1 ); // Runs
		if ( $Runs === false )
			throw new Exception( "Can't find stat #".$stat1 );

		$HR = getValue( $iPlayer, $stat2 );
		if ( $HR === false )
			throw new Exception( "Can't find stat #".$stat2 );

		$RBI = getValue( $iPlayer, $stat3 );
		if ( $RBI === false )
			throw new Exception( "Can't find stat #".$stat3 );

		$SB = getValue( $iPlayer, $stat4 );
		if ( $SB === false )
			throw new Exception( "Can't find stat#".$stat4 );

		$SLG = getValue( $iPlayer, $stat5 );
		if ( $SLG === false )
			throw new Exception( "Can't find stat#".$stat5 );

		$OBP = getValue( $iPlayer, $stat6 );
		if ( $OBP === false )
			throw new Exception( "Can't find stat#".$stat6 );

		$VORP = getValue( $iPlayer, $stat7 );
		if ( $VORP === false )
			throw new Exception( "Can't find stat#".$stat7 );

		$AB = getValue( $iPlayer, $stat8 );
		if ( $AB === false )
			throw new Exception( "Can't find stat#".$stat8 );
		if ( $AB < 20 )
			throw new Exception( "Not enough AB" );
			
		$BE = ((1/6)*(($Runs - $avgRuns)/$stdRuns) + (1/6)*(($HR - $avgHR)/$stdHR) + (1/6)*(($RBI - $avgRBI)/$stdRBI) + (1/12)*(($SB - $avgSB)/$stdSB) + (1/6)*(($SLG - $avgSLG)/$stdSLG) + (1/6)*(($OBP - $avgOBP)/$stdOBP) + (1/12)*(($VORP - $avgVORP)/$stdVORP));
		storeValue( $iPlayer, $new_stat , $BE );
	} catch ( Exception $e ) {
	}
}

?>
