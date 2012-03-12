<?
	function getPlayers(){
		$sql = "SELECT name, id FROM players";
		$res = mysql_query( $sql );
		$players = array();
		while ( $obj = mysql_fetch_object( $res ) )
			$players[ $obj->id ] = sprintf( '%s', $obj->name );
		return $players;
	}

	function getPaddedData( $statistic_id, $player_id ){
		$data = getData( $statistic_id, $player_id );
		$yesterday = floor( (time() - (60*60*6)) / 86400 );
		$values = array();
		for ( $i = 15410; $i<=$yesterday; $i++ ){
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

	function getLastDate( $statistic_id ){
		$sql = sprintf( "SELECT day FROM data WHERE statistic_id = '%d' ORDER BY day DESC LIMIT 1", $statistic_id );
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
		$lastday = getLastDate( $statistic_id );
		$sql = sprintf( "SELECT player_id FROM data WHERE statistic_id = '%d' AND day = '%s'", $statistic_id, $lastday );
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
		$lastday = getLastDate( $statistic_id );
		$sql = sprintf( "SELECT player_id, value FROM data WHERE statistic_id = '%s' AND day = '%s' ORDER BY value DESC LIMIT 3", $statistic_id, $lastday );
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

  function getValue ( $iPlayer, $iStat ) {
		$lastday = getLastDate( $iStat );
		$sql = sprintf( "SELECT * FROM data WHERE player_id = '%d' and statistic_id = '%d' and day ='%s'", $iPlayer, $iStat, $lastday);
		$res = mysql_query ( $sql );
		$obj = mysql_fetch_object( $res );
		if ( ! $obj )
			return false;
		return $obj->value;
	}

	function getListofPlayers ( ) {
		$sql = 'SELECT name, id FROM players';
		$res = mysql_query( $sql );
		$players = array();
		while ( $obj = mysql_fetch_object($res) )
			$players[ $obj->id ] = $obj->name;
		return $players;
	}

	function storeValue ( $iPlayer, $iStat, $value ) {
		$sql = sprintf( "INSERT INTO data SET player_id = '%d', statistic_id = '%d', value = '%s', day = NOW()-INTERVAL 1 DAY", $iPlayer,  $iStat,  $value );
		mysql_query ( $sql );
	}

	function getSumLeagueData( $statistic_id ){
		$lastday = getLastDate( $statistic_id );
		$sql = sprintf( "SELECT SUM( value ) as sum FROM data WHERE statistic_id = '%d' and day = '%s'", $statistic_id, $lastday );
   	$res = mysql_query ( $sql );
   	$arr = mysql_fetch_array( $res );
   	return $arr['sum'];
	}

	function getAverageLeagueData( $statistic_id ){
		$lastday = getLastDate( $statistic_id );
		$sql = sprintf( "SELECT avg( value ) as avg FROM data WHERE statistic_id = '%d' and day = '%s'", $statistic_id, $lastday );
  	$res = mysql_query ( $sql );
   	$arr = mysql_fetch_array($res);
   	return $arr['avg'];
	}

	function getStdDevLeagueData( $statistic_id ){
		$lastday = getLastDate( $statistic_id );
		$sql = sprintf( "SELECT stddev( value ) as stddev FROM data WHERE statistic_id = '%d' and day = '%s'", $statistic_id, $lastday );
   	$res = mysql_query ( $sql );
   	$arr = mysql_fetch_array($res);
   	return $arr['stddev'];
	}

	function getPlayerIdFromCBSId( $cbs_id, $name, $team, $full_team, $position ){
		$sql = sprintf( "SELECT id, team, position FROM players WHERE cbs_id = '%d'", $cbs_id );
		$res = mysql_query( $sql );
		$obj = mysql_fetch_object( $res );
		// Handle case where player is traded
		if ( $obj->team != $team || $obj->position != $position ) {
			$sql = sprintf( "UPDATE players SET team = '%s', full_team = '%s', position = '%s' WHERE cbs_id = %d LIMIT 1", $team, $full_team, $position, $cbs_id );
			mysql_query( $sql );
		}
		if ( $obj )
			return $obj->id;
		$sql = sprintf( "INSERT INTO players SET name = '%s', team = '%s', full_team = '%s', position = '%s', cbs_id = '%d', day = NOW()", 
			mysql_real_escape_string( $name ), 
			mysql_real_escape_string( $team ), 
			mysql_real_escape_string( $full_team ), 
			mysql_real_escape_string( $position ), 
			mysql_real_escape_string( $cbs_id ) );
		mysql_query( $sql );
		return mysql_insert_id();
	}

	function truehash($hash) {
		return hash('ripemd160', hash('whirlpool', hash('md2', $hash) ) );
	}

	function getPassword( $email ){
		$sql = sprintf( "SELECT password FROM members WHERE email = '%s'", $email );
		$res = mysql_query( $sql );
		$arr = mysql_fetch_array( $res );
		return $arr['password'];
	}

	function getEmailfromPassword( $password ){
		$sql = sprintf( "SELECT email FROM members WHERE password = '%s'", $password );
		$res = mysql_query( $sql );
		$arr = mysql_fetch_array( $res );
		return $arr['email'];
	}

	function getIdfromEmail( $email ){
		$sql = sprintf( "SELECT id FROM members WHERE email = '%s'", $email );
		$res = mysql_query( $sql );
		$arr = mysql_fetch_array( $res );
		return $arr['id'];
	}

	function getEmailFromID( $id ){
		$sql = sprintf( "SELECT email FROM members WHERE id = '%d'", $id );
    $res = mysql_query( $sql );
    $arr = mysql_fetch_array( $res );
    return $arr['email'];
  }

	function getEmailFromPasswordAndId( $password, $id ){
		$sql = sprintf( "SELECT email FROM members WHERE password = '%s' AND id = '%d'", $password, $id );
    $res = mysql_query( $sql );
    $arr = mysql_fetch_array( $res );
    return $arr['email'];
  }

?>
