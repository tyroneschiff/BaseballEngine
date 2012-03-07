#!/usr/bin/php
<?php

include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

  $page = file_get_contents( 'http://www.cbssports.com/mlb/stats/playersort/MLB/ERAXU/ALL/regularseason/2011?&_1:col_1=1&print_rows=9999' );

  // Parse CBS data

  $regex = '#<a href="\/mlb\/players\/playerpage\/([0-9]{1,9})\/([A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*-[A-Za-z]*)?">([^>]+)?<\/a><\/td><td  align="center">([^>]+)?<\/td><td  align="center"><a href="\/mlb\/teams\/page\/([A-Z]{2,3})\/([A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*)?">([^>]+)<\/a><\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><\/tr>#';
	
preg_match_all( $regex, $page, $cbs );

  // [1] - CBS ID
  // [2] - Full names with hyphen
  // [3] - Full Name
  // [4] - Position
  // [5] - Team initials 
  // [6] - Full team name with hyphens 
  // [7] - Team initials
  // [8] - ERA
  // [9] - Complete Games
  // [10] - Holds
  // [11] - Games Finished
  // [12] - Shut Outs
  // [13] - Quality Starts
  // [14] - Total Batters Faced
  // [15] - Balks
  // [16] - Wild Pitches
  // [17] - Singles Allowed
  // [18] - Doubles Allowed
  // [19] - Triples Allowed
  // [20] - Innings per Start
  // [21] - Ground Ball to Fly Ball Ratio
  // [22] - Men on Base per 9 innings
  // [23] - Inherited Runners Allowed to Score

$pitchingstats = array( 
	"117" => "9", 
	"118" => "10", 
	"119" => "11", 
	"120" => "12", 
	"121" => "13", 
	"122" => "14", 
	"123" => "15", 
	"124" => "16", 
	"125" => "17", 
	"126" => "18", 
	"127" => "19", 
	"128" => "20", 
	"129" => "21", 
	"130" => "22", 
	"131" => "23" 
);

foreach ( $cbs[0] as $i => $null ) {
	$cbs_id = $cbs[ 1 ][$i];
	$name = $cbs[ 3 ][$i];
	$team = $cbs[ 5 ][$i];
	$position = $cbs[ 4 ][$i];
	$full_team = $cbs[ 6 ][$i];
	
	$player_id = getPlayerIdFromCBSId( $cbs_id, $name, $team, $full_team, $position );
	echo '<p style="padding-left: 20px;">'.$name.': ['.$cbs_id.'] : '.$team.' : ['.$full_team.'] : '.$position.'</p>';
	
	foreach ( $pitchingstats as $statistic_id => $array_value ) {
		$value = $cbs[ $array_value ][ $i ];
		$sql = sprintf( "INSERT INTO data SET statistic_id = '%d', player_id = '%d', value = '%s', day = NOW()-INTERVAL 1 day", $statistic_id,  $player_id,  $value );
		echo "$sql <br/> ";
		mysql_query( $sql );
		echo "\n\n".mysql_error()."\n\n";
	}
}
?>
