<?php
class DbWrapper {
	private static $dblink;

	public static function connectToDatabase() {
		if(!self::$dblink) {
			self::$dblink = mysql_connect(Config::$mysql_path, Config::$mysql_user, Config::$mysql_password);
			if(!self::$dblink)
			return ("Es konnte keine Verbindung zur Datenbank hergestellt werden.");

			mysql_select_db(Config::$database_name, self::$dblink);
			$e = mysql_error(self::$dblink);
			if($e)
			return "MySQLError: ".$e;
		}
	}

	public static function createTables($tables) {
		if(!is_array($tables))
		return "DbWrapper::createTables() benötigt ein Array als Parameter.";
		foreach($tables as $key=>$value)
		{
			mysql_query("CREATE TABLE `".$key."` (".$value.");", self::$dblink);
			$e=mysql_error(self::$dblink);
			if($e)
			return "MySQLError: ".$e;
		}
		return "Tabellen wurden erstellt.";
	}

	/**
	 *
	 * Enter description here ...
	 * @param $id
	 * @return User the user
	 */
	public static function getUserById($id) {
		$result = mysql_query("SELECT * FROM `users` WHERE `id` = '".mysql_real_escape_string($id)."'", self::$dblink);
		if($result) {
			$arr = mysql_fetch_array($result);
			return new User($arr["id"],  $arr["name"], $arr["surname"], $arr["password"], $arr["email"], $arr["cupwinner"]);
		}
		else return NULL;
	}

	public static function deleteUser($id) {
		$result = mysql_query("DELETE  FROM `users` WHERE `id` = '".mysql_real_escape_string($id)."'", self::$dblink);
	}

	public static function acceptUser($id) {
		$result = mysql_query("UPDATE  `users` SET `accepted`= 1 WHERE `id` = '".mysql_real_escape_string($id)."'", self::$dblink);
	}

	public static function getUserByEmail($email) {
		$result = mysql_query("SELECT * FROM `users` WHERE `email` = '".mysql_real_escape_string($email)."'", self::$dblink);
		if($result) {
			$arr = mysql_fetch_array($result, MYSQL_ASSOC);
			if(!isset($arr["id"]))
			return false;
			return new User($arr["id"],  $arr["name"], $arr["surname"], $arr["password"], $arr["email"], $arr["cupwinner"]);
		}
		else return false;
	}

	/**
	 *
	 * @param $user
	 * @return Boolean
	 */
	public static function addUser($user) {
		if($user instanceof User) {
			$fields = "( name, surname, password, email, accepted)";
			$values = "('"
			.mysql_real_escape_string($user->getName())."', '"
			.mysql_real_escape_string($user->getSurname())."', '"
			.mysql_real_escape_string(md5($user->getPassword()))."', '"
			.mysql_real_escape_string($user->getMailAddress())."', '0')";
			mysql_query("INSERT INTO `users` ".$fields." VALUES ".$values, self::$dblink);
			$e=mysql_error(self::$dblink);
			if($e)
			return "MySQLError: ".$e;
			else
			return true;
		} else {
			return false;
		}
	}
	public static function getUserRequests() {
		$result = mysql_query("SELECT * FROM `users` WHERE `accepted` != '1'", self::$dblink);
		$users=array();
		if($result) {
			while($arr = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				if(isset($arr["id"]))
				$users[] =  new User($arr["id"], $arr["name"], $arr["surname"], $arr["password"], $arr["email"], $arr["cupwinner"]);
			}
			//print_r($users);

		}
		return $users;
	}

	public static function getUsers() {
		$result = mysql_query("SELECT * FROM `users` WHERE 1 ORDER BY `surname` ASC", self::$dblink);
		$users=array();
		if($result) {

			while($arr = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				if(isset($arr["id"]))
				$users[] =  new User($arr["id"], $arr["name"], $arr["surname"], $arr["password"], $arr["email"], $arr["cupwinner"],$arr["accepted"]);
			}
			//print_r($users);

		}
		return $users;
	}

	public static function getRanking() {
		$result = mysql_query("SELECT `id`, `name`, `surname`, `points` FROM `users` WHERE (NOT `name` = 'Admin') AND `accepted` = '1' ORDER BY `points` DESC", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e)
		print("MySQLError: ".$e);
		if(mysql_num_rows($result)==0) {
			return array();
		}
		else {
			while($arr = mysql_fetch_array($result, MYSQL_ASSOC)) {
				if(isset($arr["id"]))
				$points[$arr["id"]] = array($arr["name"]." ".$arr["surname"], $arr["points"]);
			}
		}
		return $points;
	}

	public static function addTeam($team) {
		if($team instanceof Team) {
			$fields = "(id, name, gruup, position)";
			$values = "('"
			.mysql_real_escape_string($team->getTeamId())."', '"
			.mysql_real_escape_string($team->getName())."', '"
			.mysql_real_escape_string($team->getGroup())."', '1')";
			//print("INSERT INTO `teams` ".$fields." VALUES ".$values);
			mysql_query("INSERT INTO `teams` ".$fields." VALUES ".$values, self::$dblink);
			$e=mysql_error(self::$dblink);
			if($e)
			return "MySQLError: ".$e;
			else
			return true;
		} else {
			return false;
		}
	}

	/**
	 *
	 * @return array
	 */
	public static function getAllTeams() {
		$result = mysql_query("SELECT * FROM `teams` ORDER BY `name`", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e) {
			print("MySQLError: ".$e);
			return array();
		}
		if(!$result) {
			return array();
		}
		while($arr = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if($arr["id"]!=0)
			$teams[] = new Team($arr["id"], $arr["name"], $arr["gruup"], $arr["position"]);
		}
		return $teams;
	}

	public static function getAllTeamsAsHashTable() {
		$result = mysql_query("SELECT * FROM `teams` ORDER BY `name`", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e) {
			print("MySQLError: ".$e);
			return array();
		}
		if(!$result) {
			return array();
		}
		while($arr = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if($arr["id"]!=0)
			$teams[$arr["id"]] = new Team($arr["id"], $arr["name"], $arr["gruup"], $arr["position"]);
		}
		return $teams;
	}

	public static function getTeamIdByName($name) {
		$result = mysql_query("SELECT `id` FROM `teams` WHERE `name` = '".mysql_real_escape_string($name)."'", self::$dblink);
		$arr = mysql_fetch_array($result, MYSQL_ASSOC);
		return $arr["id"];
	}

	public static function getTeamNameById($teamid) {
		$result = mysql_query("SELECT `name` FROM `teams` WHERE `id` = '".mysql_real_escape_string($teamid)."'", self::$dblink);
		$arr = mysql_fetch_array($result, MYSQL_ASSOC);
		return $arr["name"];
	}

	/**
	 *
	 * @return array
	 */
	public static function getTeamBetsByGroup($userid, $type) {
		$allteams = mysql_query("SELECT * FROM `teams` WHERE `gruup`='".$type."' ORDER BY `id` ASC", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e) {
			print("MySQLError: ".$e);
			return array();
		}
		$result = mysql_query("SELECT teams.id, teams.name, teams.position AS `position`, teams.gruup,
				groupBets.position AS `bet`	FROM `teams`, `groupBets` 
				WHERE groupBets.userid = '".mysql_real_escape_string($userid)."' 
				AND groupBets.teamid = teams.id 
				AND teams.gruup='".$type."' ORDER BY teams.id ASC", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e) {
			print("MySQLError: ".$e);
			return array();
		}
		if(!$allteams || !$result || mysql_num_rows($allteams)==0) {
			return array();
		}
		//merge allteams (no bets) with bets
		$b = mysql_fetch_array($result, MYSQL_ASSOC);
		while($t = mysql_fetch_array($allteams, MYSQL_ASSOC)) {
			if($b["id"] == $t["id"]) {
				$bets[] = new TeamBet($userid, new Team($b["id"], $b["name"], $b["gruup"], $b["position"]), $b["bet"]);
				$b = mysql_fetch_array($result, MYSQL_ASSOC);
			}
			else {
				$bets[] = new TeamBet($userid, new Team($t["id"], $t["name"], $t["gruup"], $t["position"]), -1);
			}
		}
		return $bets;
	}

	public static function getTeamIDsByGroup($group) {
		$result = mysql_query("SELECT `id` FROM `teams` WHERE `gruup` ='".mysql_real_escape_string($group)."'", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e)
		print("MySQLError: ".$e);
		if($result) {
			while($id = mysql_fetch_array($result)) {
				$teams[] = $id[0];
			}
		}
		return $teams;
	}

	public static function updateWinnerBet($userid, $winner) {
		mysql_query("UPDATE `users` SET `cupwinner` = '".mysql_real_escape_string($winner)."'
		WHERE `id` = '".mysql_real_escape_string($userid)."'", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e)
		print("MySQLError: ".$e);
	}

	public static function updateGroupBets($userid, $bets) {
		if(!is_array($bets)) return;
		foreach($bets as $teamid=>$pos) {
			$exist = mysql_query("SELECT * FROM `groupBets` WHERE `userid` = '".mysql_real_escape_string($userid)."'
					AND `teamid` = '".$teamid."'", self::$dblink);
			if(mysql_num_rows($exist)==0) {
				mysql_query("INSERT INTO `groupBets` ( `userid`, `teamid`, `position` )
					VALUES ( '".mysql_real_escape_string($userid)."', '".mysql_real_escape_string($teamid)."', 
					'".$pos."' )", self::$dblink);
			}
			else {
				mysql_query("UPDATE `groupBets` SET `position`='".$pos."'
					WHERE `userid` = '".mysql_real_escape_string($userid)."' 
					AND `teamid` = '".mysql_real_escape_string($teamid)."'", self::$dblink);
			}
			$e=mysql_error(self::$dblink);
			if($e)
			print("MySQLError: ".$e);}
	}

	public static function addGame($game) {
		if($game instanceof Game) {
			$fields = "(id, type, time, team1, team2, goals1, goals2)";
			$values = "('"
			.mysql_real_escape_string($game->getGameId())."', '"
			.mysql_real_escape_string($game->getType())."', '"
			.mysql_real_escape_string($game->getTime())."', '"
			.mysql_real_escape_string($game->getFirstTeam())."', '"
			.mysql_real_escape_string($game->getSecondTeam())."', '"
			.mysql_real_escape_string($game->getFirstTeamGoals())."', '"
			.mysql_real_escape_string($game->getSecondTeamGoals())."')";
			//print("INSERT INTO `matches` ".$fields." VALUES ".$values);
			mysql_query("INSERT INTO `matches` ".$fields." VALUES ".$values, self::$dblink);
			$e=mysql_error(self::$dblink);
			if($e)
			return "MySQLError: ".$e;
			else
			return true;
		} else {
			return false;
		}
	}


	public static function setGameResult($gameId,$goals1,$goals2,$endgoals1=-1,$endgoals2=-1) {
		$endGoalsUpdate="";
		if($endgoals1=="")
		{
			$endgoals1=-1;
			$endgoals2=-1;
		}
		mysql_query("UPDATE `matches` SET `goals1`='".mysql_real_escape_string($goals1)."', `goals2`='".mysql_real_escape_string($goals2)."'
					, `realgoal1`='".mysql_real_escape_string($endgoals1)."' ,`realgoal2`='".mysql_real_escape_string($endgoals2)."'
					 WHERE `id` = '".mysql_real_escape_string($gameId)."'", self::$dblink);	
	}


	public static function getMatchBetsByUser($userid) {
		$result = mysql_query("SELECT  matchBets.userid, matchBets.matchid, matchBets.goals1, matchBets.goals2
				 FROM `matchBets`, `matches` WHERE
				`userid` ='".mysql_real_escape_string($userid)."' 
				AND matches.id = `matchid` ORDER BY matches.time ASC", self::$dblink);
		$e=mysql_error(self::$dblink);
		$matches=array();
		if($e)
		print("MySQLError: ".$e);
		if($result) {
			while($row = mysql_fetch_assoc($result)) {
				$matches[] = $row;
			}
		}
		return $matches;

	}
	/**
	 * Returns all match bets of the user belonging to games of type $type.
	 * If the user has not bet yet, a match bets score is set null.
	 *
	 * @param $userid
	 * @return Array an array of MatchBets
	 */
	public static function getMatchBetsByType($userid, $type) {
		$allmatches = mysql_query("SELECT matches.id, matches.time, team1.name AS team1,
			 team2.name AS team2, matches.goals1, matches.goals2,matches.realgoal1,matches.realgoal2 FROM `matches`, 
			 `teams` AS `team1`, `teams` AS `team2`
			 WHERE matches.type = '".mysql_real_escape_string($type)."'
			 AND matches.team1 = team1.id AND matches.team2 = team2.id ORDER BY matches.id ASC", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e) {
			print("MySQLError: ".$e);
			return array();
		}

		$fields = "matches.id AS matchid, matches.time, matches.goals1, matches.goals2,matches.realgoal1, matches.realgoal2, matchBets.goals1 AS betGoals1, matchBets.goals2 AS betGoals2,
			 team1.id AS team1id, team1.name AS team1name, team2.id AS team2id, team2.name AS team2name";
		$result = mysql_query("SELECT ".$fields." FROM `matches`, `matchBets`, `teams` AS `team1`, `teams` AS `team2`
			 WHERE matchBets.userid = '".mysql_real_escape_string($userid)."' AND matchBets.matchid = matches.id 
			 AND matches.type = '".mysql_real_escape_string($type)."'
			 AND matches.team1 = team1.id AND matches.team2 = team2.id ORDER BY `matchid` ASC", self::$dblink);

		$e=mysql_error(self::$dblink);
		if($e) {
			print("MySQLError: ".$e);
			return array();
		}
		if(!$allmatches || !$result || mysql_num_rows($allmatches)==0) {
			return array();
		}
		/* merge matches without bets with bets*/
		$b = mysql_fetch_array($result, MYSQL_ASSOC);
		while($m = mysql_fetch_array($allmatches, MYSQL_ASSOC)) {
			if($b["matchid"] == $m["id"]) {
				$bets[] = new MatchBet($userid, new Game($b["matchid"], $type, $b["time"],
				$b["team1name"], $b["team2name"], $b["goals1"], $b["goals2"],$b["realgoal1"], $b["realgoal2"]),
				new Score($b["betGoals1"], $b["betGoals2"]));
				$b = mysql_fetch_array($result, MYSQL_ASSOC);
			} else {
				$bets[] = new MatchBet($userid, new Game($m["id"], $type, $m["time"],
				$m["team1"], $m["team2"], $m["goals1"], $m["goals2"],$m["realgoal1"], $m["realgoal2"]), null);
			}
		}
		return $bets;
	}

	public static function getMatchById($matchid) {
		$result = mysql_query("SELECT * FROM `matches` WHERE `id` ='".mysql_real_escape_string($matchid)."'", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e)
		print("MySQLError: ".$e);
		if($result) {
			$arr = mysql_fetch_array($result);
			return new Game($arr["id"], $arr["type"], $arr["time"], $arr["team1"], $arr["team2"], $arr["goals1"], $arr["goals2"],$arr["realgoal1"],$arr["realgoal2"]);
		}
		return null;
	}

	public static function getMatchIDsByType($type) {
		$result = mysql_query("SELECT `id` FROM `matches` WHERE `type` ='".mysql_real_escape_string($type)."'", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e)
		print("MySQLError: ".$e);
		if($result) {
			while($id = mysql_fetch_array($result)) {
				$matches[] = $id[0];
			}
		}
		return $matches;
	}

	public static function getMatchesByType($type) {
		$result = mysql_query("SELECT * FROM `matches` WHERE `type` ='".mysql_real_escape_string($type)."'", self::$dblink);
		$e=mysql_error(self::$dblink);
		$matches=array();
		if($e)
		print("MySQLError: ".$e);
			
		if($result) {
			while($resultRow = mysql_fetch_assoc($result)) {
				$matches[] = new Game($resultRow["id"],$resultRow["type"],$resultRow["time"],$resultRow["team1"],$resultRow["team2"],$resultRow["goals1"],$resultRow["goals2"],$resultRow["realgoal1"],$resultRow["realgoal2"]);
			}
		}
		return $matches;
	}

	public static function getAllMatches() {
		$result = mysql_query("SELECT * FROM `matches` WHERE 1", self::$dblink);
		$e=mysql_error(self::$dblink);
		$matches=array();
		if($e)
		print("MySQLError: ".$e);
			
		if($result) {
			while($resultRow = mysql_fetch_assoc($result)) {
				$matches[$resultRow["id"]] = new Game($resultRow["id"],$resultRow["type"],$resultRow["time"],$resultRow["team1"],$resultRow["team2"],$resultRow["goals1"],$resultRow["goals2"],$resultRow["realgoal1"],$resultRow["realgoal1"]);
			}
		}
		return $matches;
	}

	public static function updateMatchBets($userid, $bets) {
		if(!is_array($bets)) return;
		foreach($bets as $matchid=>$score) {
			$exist = mysql_query("SELECT * FROM `matchBets` WHERE `userid` = '".mysql_real_escape_string($userid)."'
					AND `matchid` = '".$matchid."'", self::$dblink);
			if(mysql_num_rows($exist)==0) {
				mysql_query("INSERT INTO `matchBets` ( `userid`, `matchid`, `goals1`, `goals2` )
					VALUES ( '".mysql_real_escape_string($userid)."', '".mysql_real_escape_string($matchid)."', 
					'".$score->getFirstTeamGoals()."', '".$score->getSecondTeamGoals()."' )", self::$dblink);
			}
			else {
				mysql_query("UPDATE `matchBets` SET `goals1`='".$score->getFirstTeamGoals()."',
					`goals2`='".$score->getSecondTeamGoals()."' WHERE `userid` = '".mysql_real_escape_string($userid)."'
					AND `matchid` = '".mysql_real_escape_string($matchid)."'", self::$dblink);
			}
			$e=mysql_error(self::$dblink);
			if($e)
			print("MySQLError: ".$e);
		}
	}

	public static function updateUserPoints($userid, $points) {
		mysql_query("UPDATE `users` SET `points`='".mysql_real_escape_string($points)."'
					WHERE `id` = '".mysql_real_escape_string($userid)."'", self::$dblink);	
	}

	public static function getUserPoints($userid) {
		$result = mysql_query("SELECT `points` FROM `users` WHERE `id` = '".mysql_real_escape_string($userid)."'", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e)
		print("MySQLError: ".$e);
		if(!$result) {
			return -1;
		}
		else {
			$arr = mysql_fetch_array($result);
			return $arr[0];
		}
	}

	public static function updateScoreHistory($time, $userid, $points) {
		$exist = mysql_query("SELECT * FROM `score` WHERE `time` = '".mysql_real_escape_string($time)."' AND
					`userid` = '".mysql_real_escape_string($userid)."'", self::$dblink);
		if(mysql_num_rows($exist)==0) {
			mysql_query("INSERT INTO `score` ( `time`, `userid`, `points` )
					VALUES ( '".mysql_real_escape_string($time)."', '".mysql_real_escape_string($userid)."', 
					'".mysql_real_escape_string($points)."' )", self::$dblink);
		}
		else {
			mysql_query("UPDATE `score` SET `points`='".mysql_real_escape_string($points)."'
				WHERE `time` = '".mysql_real_escape_string($time)."' AND 
				`userid` = '".mysql_real_escape_string($userid)."'", self::$dblink);
		}
		$e=mysql_error(self::$dblink);
		if($e)
		print("MySQLError: ".$e);
	}

	public static function getLatestScoreHistory() {
		$t = mysql_query("SELECT `time` FROM `score` GROUP BY `time` ORDER BY `time` DESC", self::$dblink);
		if(mysql_num_rows($t)<=1) {
			return array();
		}
		$tarr = mysql_fetch_array($t);
		$tarr = mysql_fetch_array($t);
		$latest = $tarr[0];

		$result = mysql_query("SELECT `userid`, `points` FROM `score` WHERE `time` = '
				".mysql_real_escape_string($latest)."' AND (NOT `userid` = '1') ORDER BY `points` DESC", self::$dblink);


		if($result) {
			$i = 1; //increments when score differs
			$j = 1; //increments always
			$oldscore = -1;
			while($arr = mysql_fetch_array($result, MYSQL_ASSOC)) {
				if($oldscore != $arr["points"]) {
					$i = $j;
					$oldscore = $arr["points"];
				}
				$points[$arr["userid"]] = array($arr["points"], $i);
				$j++;
			}
		} else {
			return array();
		}
		return $points;
	}

	public static function getScoreHistory($datetime) {
		if($datetime instanceof DateTime) {
			$result = mysql_query("SELECT `userid`, `points` FROM `score` WHERE `time` = '
				".mysql_real_escape_string($datetime->format("Y-m-d H:i:s"))."' AND (NOT `userid` = '1') ORDER BY `points` DESC", self::$dblink);

			if($result) {
				while($arr = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$points[$arr["userid"]] = $arr["points"];
				}
			} else {
				return array();
			}
			return $points;
		} else {
			return array();
		}
	}

	/**
	 * 
	 * @param $userid
	 * @return Array of (time, points, rank), time ascending
	 */
	public static function getUserHistory($userid) {

		$result = mysql_query("SELECT `points`, `rank`, `time` FROM `score` WHERE `userid` = '
				".mysql_real_escape_string($userid)."' ORDER BY `time` ASC", self::$dblink);

		if($result) {
			while($arr = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$history[] = array($arr["time"], $arr["points"], $arr["rank"]);
			}
		} else {
			return array();
		}
		return $history;
	}

	public static function setHistoryRank($datetime, $userid, $rank) {
		if($datetime instanceof DateTime) {
			mysql_query("UPDATE `score` SET `rank`='".mysql_real_escape_string($rank)."'
				WHERE `time` = '".mysql_real_escape_string($datetime->format("Y-m-d H:i:s"))."' AND 
				`userid` = '".mysql_real_escape_string($userid)."'", self::$dblink);
			$e=mysql_error(self::$dblink);
			if($e)
			print("MySQLError: ".$e);
		}
	}

	public static function isPayingUser($userid) {
		$result = mysql_query("SELECT `paying` FROM `users` WHERE `id` = '".mysql_real_escape_string($userid)."'", self::$dblink);
		$e=mysql_error(self::$dblink);
		if($e)
		print("MySQLError: ".$e);
		if(!$result) {
			return NULL;
		}
		else {
			$arr = mysql_fetch_array($result);
			return ($arr[0]==1?true:false);
		}
	}

	public static function setAsPayingUser($userid) {
		mysql_query("UPDATE `users` SET `paying`='1' WHERE `id` = '".mysql_real_escape_string($userid)."'", self::$dblink);
	}

	public static function execute($query)
	{
		return mysql_query($query,self::$dblink);
	}
}
?>