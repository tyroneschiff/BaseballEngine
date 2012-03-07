#!/usr/bin/php
<?

include '/home/tyrone/baseballengine1.2/connect.php';
include '/home/tyrone/baseballengine1.2/functions.php';

  $page = file_get_contents( 'http://www.cbssports.com/mlb/stats/playersort/MLB/AVGU/ALL/regularseason/2011?&_1:col_1=1&_1:col_2=4&print_rows=9999' );

  // Parse CBS data 

  $regex = '#<a href="\/mlb\/players\/playerpage\/([0-9]{1,9})\/([A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*-[A-Za-z]*)?">([^>]+)?<\/a><\/td><td  align="center">([^>]+)?<\/td><td  align="center"><a href="\/mlb\/teams\/page\/([A-Z]{2,3})\/([A-Za-z]*-[A-Za-z]*|[A-Za-z]*-[A-Za-z]*-[A-Za-z]*)?">([^>]+)<\/a><\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><td >([^>]+)<\/td><\/tr>#';

  preg_match_all( $regex, $page, $cbs );

  // [1] - CBS ID
  // [2] - Partial list of full names
  // [3] - Full Name
  // [4] - Position
  // [5] - Team initials
  // [6] - Team name with hyphens
  // [7] - Team initials
  // [8] - Average
  // [9] - At bats
  // [10] - Runs
  // [11] - Hits
  // [12] - Doubles
  // [13] - Triples
  // [14] - Home Runs
  // [15] - Runs Batted In
  // [16] - Stolen Bases
  // [17] - Caught Stealing
  // [18] - Walks
  // [19] - Strike Outs
  // [20] - On Base Percentage
  // [21] - Slugging
  // [22] - On base percentage plus slugging

$stats = array( 
	"1" => "8", 
	"2" => "9", 
	"3" => "10", 
	"4" => "11", 
	"5" => "12", 
	"6" => "13", 
	"7" => "14", 
	"8" => "15", 
	"9" => "16", 
	"10" => "17", 
	"11" => "18", 
	"12" => "19", 
	"13" => "20", 
	"14" => "21", 
	"15" => "22" 
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
    echo "$sql <br/> ";
    
	  mysql_query( $sql );

		echo "\n\n".mysql_error()."\n\n";
  }

}

?>
