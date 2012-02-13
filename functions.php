<?

	function getPlayers(){
		$sql = "SELECT name, position, team, id FROM players";
		$res = mysql_query( $sql );
		$players = array();
		while ( $obj = mysql_fetch_object( $res ) )
			$players[ $obj->id ] = sprintf( '%s (%s %s)', $obj->name, $obj->position, $obj->team );
		return $players;
	}

	function getPaddedData( $statistic_id, $player_id ){
		$data = getData( $statistic_id, $player_id );
		$yesterday = floor( (time() - (60*60*15)) / 86400 );
		$values = array();
		for ( $i = 15065; $i <= 15250; $i++ ){
			$day = date( 'Y-m-d', $i*86400 );
			if ( array_key_exists($day,$data) )
				$values[ $day ] = $data[ $day ];
			else $values[ $day ] = null;
		}
		return $values;
	}

	function getData( $statistic_id, $player_id ){
		$sql = sprintf( "SELECT value, day FROM data WHERE statistic_id = '%d' AND player_id = '%d'", $statistic_id, $player_id );
		$res = mysql_query( $sql );
		$values = array();
		while ( $arr = mysql_fetch_array( $res ) ){
			$values[ $arr['day'] ] = (float) $arr['value'];
		}
		return $values;
	}

	function getBatters(){
		$sql = "SELECT name, id, position, team FROM players WHERE position != 'SP' AND position != 'RP' AND position != 'P'";
		$res = mysql_query( $sql );
		$players = array();
		while ( $arr = mysql_fetch_array( $res ) )
			$players[] = sprintf( '%s (%s %s)', $arr['name'], $arr['position'], $arr['team'] );
		return $players;
	}

?>
