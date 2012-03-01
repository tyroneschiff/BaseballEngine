<?
	function getPlayers(){
		$sql = "SELECT name, position, team, id FROM players";
		$res = mysql_query( $sql );
		$players = array();
		while ( $obj = mysql_fetch_object( $res ) )
			$players[ $obj->id ] = sprintf( '%s ( %s %s )', $obj->name, $obj->position, $obj->team );
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
		while ( $obj = mysql_fetch_object( $res ) )
			$players[ $obj->id ] = $obj;
		return $players;
	}

	function getLastDate(){
		$sql = "SELECT day FROM data ORDER BY day DESC LIMIT 1";
		$res = mysql_query( $sql );
		$arr = mysql_fetch_array( $res );
		return $arr['day'];
	}

	function getPlayerDetailsFromId( $id ){
		$sql = sprintf( "SELECT name, team, position FROM players WHERE id = '%d'", $id );
		$res = mysql_query( $sql );
		$arr = mysql_fetch_array( $res );
		return sprintf( '%s ( %s %s )', $arr['name'], $arr['position'], $arr['team'] );
	}

	function getPlayersBasedOnStatistic( $statistic_id ){
		$lastDay = getLastDate();
    $sql = sprintf( "SELECT player_id FROM data WHERE statistic_id = '%d' AND day = '%s'", $statistic_id, $lastDay );
    $res = mysql_query( $sql );
    $ids = array();
    while ( $arr = mysql_fetch_array( $res ) ){
      $ids[] = $arr['player_id'];    }
    $player_names = array();
    foreach ( $ids as $key => $player_id ){
      $player_names[] = getPlayerDetailsFromId( $player_id );
    }
    return $player_names;
  }

	function arrayMerge( array $array ){
		$flatten = array();
		array_walk_recursive( $array, function($value) use(&$flatten) {
			$flatten[] = $value;
		});
		return $flatten;
	}

	function removeNulls( $nulls ){
		return !is_null( $nulls );
	}

	function getTopThree( $statistic_id ){
		$lastDay = getLastDate();
		$sql = sprintf( "SELECT player_id, value FROM data WHERE statistic_id = '%s' AND day = '%s' ORDER BY value DESC LIMIT 3", $statistic_id, $lastDay );
		$res = mysql_query( $sql );
		$ids = array();
		while ( $arr = mysql_fetch_array( $res ) ){
			$ids[] = $arr['player_id'];
		}
		$player_names = array();
		foreach ( $ids as $key => $player_id ){
			$player_names[] = getPlayerDetailsFromId( $player_id );
		}
		return $player_names;
	}

	function getStatisticIdFromStatistic( $statistic, $type ){
		$sql = sprintf( "SELECT id FROM statistics WHERE stat_name = '%s' AND type = '%s'", $statistic, $type );
		$res = mysql_query( $sql );
		$arr = mysql_fetch_array( $res );
		return $arr['id'];
	}

?>
