<?
	
  $_POST['players'] = array( 'C. Gonzalez (LF COL)', 'A. Pujols (1B STL)' );
  $_POST['statistic_id'] = 2;
	
  require 'connect.php';
	require 'functions.php';

  $statistic_id = $_POST['statistic_id'];

  $config = (object) null;
  $config->series = array();
  $config->xAxis = (object) null;

  $players = getPlayers();
  foreach ( $_POST['players'] as $i => $player ) {
    $player_id = array_search( $player, $players );
    if ( ! $player_id )
      continue;
    $config->series[$i] = (object) null;
    $config->series[$i]->name = preg_replace( '# \([^\)]+\)$#', null, $player );
    $data = getPaddedData( $statistic_id, $player_id );
    $config->series[$i]->data = array_values( $data );
		if ( ! isset($config->xAxis->categories) )
			$config->xAxis->categories = array();
		foreach ( $data as $day => $val )
			$config->xAxis->categories[] = date( 'M j, y', strtotime($day) );
  }

  echo json_encode( $config );

?>
