<?php
include_once(dirname(__FILE__)."/../../common.php");
Common::loginCheck();
$types = array("A","B","C","D","E","F","G","H","8Fin","4Fin","2Fin","3Fin","1Fin");

$historyDates = array("2010-06-12 20:00:00","2010-06-14 00:00:00","2010-06-15 15:50:00","2010-06-16 20:00:00",
				"2010-06-18 00:00:00","2010-06-19 15:50:00","2010-06-20 20:00:00","2010-06-22 00:0:00",
				"2010-06-23 00:00:00","2010-06-24 00:00:00","2010-06-25 00:00:00","2010-06-26 00:00:00",
				"2010-06-28 00:00:00", "2010-06-30 00:00:00", "2010-07-04 00:00:00", "2010-07-08 00:00:00", 
				"2010-07-11 00:00:00", "2010-07-12 00:00:00");
$now = new DateTime();

foreach($types as $key=>$value) {
	if($_POST["matchbet_".$value]) {
		$type = $value;
		$matches=DbWrapper::getMatchesByType($type);
		foreach($matches as $match)
		{
			$gameId=$match->getGameId();
			$score1=$_POST[$gameId."a"];
			$score2=$_POST[$gameId."b"];
			$score1e=$_POST[$gameId."a2"];
			$score2e=$_POST[$gameId."b2"];

			if(($score1=="")||($score2==""))
			DbWrapper::setGameResult($gameId,-1,-1);
			else
			DbWrapper::setGameResult($gameId,$score1,$score2,$score1e,$score2e);
		}
	}
}

$matches=DbWrapper::getAllMatches();
//history
$groupPoints = array();
$winnerPoints = array();



$users=DbWrapper::getUsers();
foreach($users as $user)
{
	$userid=$user->getUserId();
	$userPoints=0;
	$historyCount = 0;
	if(!$user->isAccepted())
	continue;
	$matchesOfUser=DbWrapper::getMatchBetsByUser($userid);
	foreach($matchesOfUser as $userMatch)
	{
		$betTendency=0;
			
		if($userMatch["goals1"]>$userMatch["goals2"])
		$betTendency=1;
		if($userMatch["goals1"]<$userMatch["goals2"])
		$betTendency=-1;

		$betDistance=$userMatch["goals1"]-$userMatch["goals2"];
			
		$game=	$matches[$userMatch["matchid"]];

		//history
		$gameTime = new DateTime($game->getTime());
		while(($historyCount<sizeof($historyDates)) && (new DateTime($historyDates[$historyCount]) < $gameTime) && (new DateTime($historyDates[$historyCount]) < $now)) {
			DbWrapper::updateScoreHistory($historyDates[$historyCount], $userid, $userPoints);
			$historyCount++;
		}

		if(($game->getFirstTeamGoals()!=-1)&&($game->getSecondTeamGoals()!=-1)) {
			$gameTendency=0;
			if($game->getFirstTeamGoals()>$game->getSecondTeamGoals())
			$gameTendency=1;
			if($game->getFirstTeamGoals()<$game->getSecondTeamGoals())
			$gameTendency=-1;
			$gameDistance=$game->getFirstTeamGoals() - $game->getSecondTeamGoals();
			if($gameTendency==$betTendency)
			{
				$userPoints+=1;
				//print("Tendency OK ");
			}
			else
			{
				//print("Tendency not OK:  ".$betTendency." ".$gameTendency);
			}
			if($betDistance==$gameDistance)
			{
				$userPoints+=1;
				//print("Distance OK ");
			}
			if(($game->getFirstTeamGoals()==$userMatch["goals1"])&&($game->getSecondTeamGoals()==$userMatch["goals2"]))
			{
				$userPoints+=1;
				//print("Goals OK ");
			}
			//print($game->getFirstTeamGoals()." : ".$game->getSecondTeamGoals()."  getippt: ".$userMatch["goals1"]." : ".$userMatch["goals2"]." punkte: ".$userPoints."<br>");
		}
	}

	while(($historyCount<sizeof($historyDates)) && (new DateTime($historyDates[$historyCount]) < $now)) {
		DbWrapper::updateScoreHistory($historyDates[$historyCount], $userid, $userPoints);
		$historyCount++;
	}

	//start group valuation

	$query="SELECT `gruup` FROM `teams` GROUP BY `gruup`";
	$result=DbWrapper::execute($query);
	$groups=array();

	while($row=mysql_fetch_assoc($result))
	{
		$groups[]=$row['gruup'];
	}

	foreach($groups as $group)
	{
		$groupBets = DbWrapper::getTeamBetsByGroup($userid, $group);
		$pointsForThisGroup=0;
		$correctGroupWinner=0;
		foreach($groupBets as $bet)
		{
			/**
			 * @var TeamBet $bet   is a game
			 */
			if($bet->getBetPosition() == $bet->getRealPosition())
			{
				$pointsForThisGroup++;

			}
			if(($bet->getRealPosition()<3)&&($bet->getBetPosition()<3))
			$correctGroupWinner++;

		}
		if($correctGroupWinner==2)
		{
			$pointsForThisGroup++;
		}
		if($pointsForThisGroup==5)
		$pointsForThisGroup++;
		$userPoints+=$pointsForThisGroup;
		// needed for history
		$groupPoints[$userid] += $pointsForThisGroup;
	}

	// world cup winner evaluation
	// Spain? -> teamid = 29
	if($user->getCupWinner() == 29) {
		$winnerPoints[$userid] += 5;
		$userPoints += 5;
	}

	DbWrapper::updateUserPoints($userid,$userPoints);
}

// compute history ranks
foreach($historyDates as $value) {
	$time = new DateTime($value);
	$userHistory = DbWrapper::getScoreHistory($time);
	
	if($time >= Time::getPrelimEnd()) {
		foreach($userHistory as $userid=>$points) {
			$userHistory[$userid] = $points + $groupPoints[$userid];
		}
	}
	if($time >= Time::getWorldCupEnd()) {
		foreach($userHistory as $userid=>$points) {
			$userHistory[$userid] = $points + $winnerPoints[$userid];
		}
	}
	
	// associative sorting in reverse order
	arsort($userHistory);
	
	$i = 1; //increments when score differs
	$j = 1; //increments always
	$oldscore = -1;
	foreach($userHistory as $userid=>$points) {
		if($oldscore != $points) {
			$i = $j;
			$oldscore = $points;
		}
		DbWrapper::setHistoryRank($time, $userid, $i);
		$j++;
	}
}


Common::redirect("pages/resultsAdmin.php");

?>