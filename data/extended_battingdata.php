#!/usr/bin/php
<?

include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

  $page = file_get_contents( 'http://www.cbssports.com/mlb/stats/playersort/MLB/AVGXU/ALL/preseason/2012?&_3:col_1=1&_3:col_2=4' );

  // Parse CBS data 

  $regex = '#<a href="\/mlb\/players\/playerpage\/([0-9]{1,9})\/([A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*-[A-Za-z]*)?">([^>]+)?<\/a><\/td><td  align="center">([^>]+)?<\/td><td  align="center"><a href="\/mlb\/teams\/page\/([A-Z]{2,3})\/([A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*)?">([^>]+)<\/a><\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><\/tr>#';

  preg_match_all( $regex, $page, $cbs );

  // [1] - CBS ID
  // [2] - Partial list of full names
  // [3] - Full Name
  // [4] - Position
  // [5] - Team initials
  // [6] - Team name with hyphens
  // [7] - Team initials
  // [8] - Average
  // [9] - Games Played
  // [10] - Games Started
  // [11] - Total Bases
  // [12] - Sacrifice Hit
  // [13] - Sacrifice Fly
  // [14] - Grounded Into Double Play
  // [15] - Total Plate Appearances
  // [16] - Hit By Pitch
  // [17] - Intentional Walks
  // [18] - Hitting Streak
  // [19] - AB (RISP)
  // [20] - Hits (RISP)
  // [21] - AVG (RISP)

$stats = array( 
	"16" => "9", 
	"17" => "10", 
	"18" => "11", 
	"19" => "12", 
	"20" => "13", 
	"21" => "14", 
	"22" => "15", 
	"23" => "16", 
	"24" => "17", 
	"25" => "18", 
	"26" => "19", 
	"27" => "20", 
	"28" => "21", 
);

foreach ( $cbs[0] as $i => $null ) {
	$cbs_id = $cbs[ 1 ][$i];
	$name = $cbs[ 3 ][$i];
	$team = $cbs[ 5 ][$i];
	$position = $cbs[ 4 ][$i];
	$full_team = $cbs[ 6 ][$i];
	
	$player_id = getPlayerIdFromCbsId ( $cbs_id, $name, $team, $full_team, $position );
	echo '<p style="padding-left: 20px;">'.$name.': ['.$cbs_id.'] : '.$team.' : ['.$full_team.'] : '.$position.'</p>';
	
	foreach ( $stats as $statistic_id => $array_value ) {
		$value = $cbs[ $array_value ][ $i ];
		$sql = sprintf( "INSERT INTO data SET statistic_id = '%d', player_id = '%d', value = '%s', day = NOW()-INTERVAL 1 day", $statistic_id,  $player_id,  $value );
		mysql_query( $sql );
		echo "\n\n".mysql_error()."\n\n";
	}
}
?>
