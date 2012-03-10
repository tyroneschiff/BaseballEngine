#!/usr/bin/php
<?
ini_set( 'display_errors', 'on' );
include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

$stat1 = 104; // Wins
$stat2 = 114; // KO
$stat3 = 112; // ERA
$stat4 = 116; // WHIP
$stat5 = 134; // BAA
$stat6 = 107; // Saves
$stat7 = 130; // MB9
$stat8 = 103; // IP

$new_stat = 132;

$avgWins = getAverageLeagueData( 104 );
$avgKO = getAverageLeagueData( 114 );
$avgERA = getAverageLeagueData( 112 );
$avgWHIP = getAverageLeagueData( 116 );
$avgBAA = getAverageLeagueData( 134 );
$avgSaves = getAverageLeagueData( 107 );
$avgMB9 = getAverageLeagueData( 130 );

$stdWins = getStdDevLeagueData( 104 );
$stdKO = getStdDevLeagueData( 114 );
$stdERA = getStdDevLeagueData( 112 );
$stdWHIP = getStdDevLeagueData( 116 );
$stdBAA = getStdDevLeagueData( 134 );
$stdSaves = getStdDevLeagueData( 107 );
$stdMB9 = getStdDevLeagueData( 130 );

$aPlayer = getListOfPlayers();

foreach ( $aPlayer as $iPlayer => $name ) {
  try {
		$Wins = getValue( $iPlayer, $stat1 ); // Wins
		if ( $Wins === false )
			throw new Exception( "Can't find stat #".$stat1 );

		$KO = getValue( $iPlayer, $stat2 );
		if ( $KO === false )
			throw new Exception( "Can't find stat #".$stat2 );

		$ERA = getValue( $iPlayer, $stat3 );
		if ( $ERA === false )
			throw new Exception( "Can't find stat #".$stat3 );

		$WHIP = getValue( $iPlayer, $stat4 );
		if ( $WHIP === false )
			throw new Exception( "Can't find stat#".$stat4 );

		$BAA = getValue( $iPlayer, $stat5 );
		if ( $BAA === false )
			throw new Exception( "Can't find stat#".$stat5 );

		$Saves = getValue( $iPlayer, $stat6 );
		if ( $Saves === false )
			throw new Exception( "Can't find stat#".$stat6 );

		$MB9 = getValue( $iPlayer, $stat7 );
		if ( $MB9 === false )
			throw new Exception( "Can't find stat#".$stat7 );

		$IP = getValue( $iPlayer, $stat8 );
		if ( $IP === false )
			throw new Exception( "Can't find stat#".$stat8 );
		if ( $IP < 20 )
			throw new Exception( "Not enough IP<br/>" );

		$BE = ((1/6)*(($Wins - $avgWins)/$stdWins) + (1/6)*(($KO - $avgKO)/$stdKO) + (1/12)*(($Saves - $avgSaves)/$stdSaves) - (1/12)*(($MB9 - $avgMB9)/$stdMB9) - (1/6)*(($ERA - $avgERA)/$stdERA) - (1/6)*(($WHIP - $avgWHIP)/$stdWHIP) - (1/6)*(($BAA - $avgBAA)/$stdBAA));
		storeValue( $iPlayer, $new_stat , $BE );
	} catch ( Exception $e ) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

?>
