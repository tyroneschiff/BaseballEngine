#!/usr/bin/php
<?php

include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

  $page = file_get_contents( 'http://www.cbssports.com/mlb/stats/playersort/MLB/ERAU/ALL/preseason/2012?&_1:col_1=1' );

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
  // [8] - Games Played
  // [9] - Games Started
  // [10] - Innings Pitched
  // [11] - Wins
  // [12] - Losses
  // [13] - Saves
  // [14] - Save Opportunities
  // [15] - Hits Allowed
  // [16] - Runs Allowed
  // [17] - Home Runs Allowed
  // [18] - Earned Runs
  // [19] - Earned Run Average
  // [20] - Walks Allowed
  // [21] - Strike Outs
  // [22] - Total Pitches
  // [23] - WHIP

$pitchingstats = array( 
	"101" => "8",
	"102" => "9", 
	"103" => "10", 
	"104" => "11", 
	"105" => "12", 
	"106" => "13", 
	"107" => "14", 
	"108" => "15", 
	"109" => "16", 
	"110" => "17", 
	"111" => "18", 
	"112" => "19", 
	"113" => "20", 
	"114" => "21", 
	"115" => "22", 
	"116" => "23", 
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
    mysql_query( $sql );
  	echo "\n\n".mysql_error()."\n\n";
	}
}

?>
