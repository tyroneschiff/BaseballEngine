<?
	require 'connect.php';
	require 'functions.php';
	
	$statistic_id = 63;
	$player_names = $_POST['player_names'];
	
	$config = (object) null;
	$config->series = array();
	$config->xAxis = (object) null;
	$config->yAxis = (object) null;

	if ( $player_names != "null" ){
		$players = getPlayers();
		foreach ( $player_names as $i => $player ) {
			$player_id = array_search( $player, $players );
			if ( ! $player_id )
				continue;
			$config->series[$i] = (object) null;
			$config->series[$i]->name = preg_replace( '#\([^\)]+\)$#', null, $player );
			$data = getPaddedData( $statistic_id, $player_id );
			$config->series[$i]->data = array_values( $data );
		
			$values[] = array_values( $data );
			$arr[] = array_keys( $data );
		
			if ( ! isset($config->xAxis->categories) )
				$config->xAxis->categories = array();
			foreach ( $data as $day => $val )
				$config->xAxis->categories[] = date( 'M j, y', strtotime($day) );
		}
	
		// Combine the array of arrays (if there is more than 1 player)
		$values = arrayMerge($values);
	
		// Store the maximum
		$maximum = max($values);
	
		// Redefine $values by removing the NULL values from the combined array
		$values = array_filter($values, "removeNulls");
	
		// Store the minimum
		$minimum = min($values);
	
		$config->yAxis->max = $maximum;
		$config->yAxis->min = $minimum;
	
		$count = count($arr[0]);
		$config->xAxis->tickInterval = ceil($count/10);
	
		echo json_encode( $config );
	} else {
		echo json_encode( $config );
	}
		
	
?>
