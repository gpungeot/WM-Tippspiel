<?php
include_once(dirname(__FILE__)."/../../common.php");
Common::loginCheck();
$types = array("A","B","C","D","E","F","G","H","8Fin","4Fin","2Fin","3Fin","1Fin");

//var_dump($_POST);die;

$historyDates = array("2010-06-13 00:00:00",
        "2014-06-14 00:00:00","2014-06-14 10:00:00",
        "2014-06-15 00:00:00","2014-06-15 10:00:00",
        "2014-06-16 00:00:00","2014-06-16 10:00:00",
        "2014-06-17 00:00:00","2014-06-17 10:00:00",
        "2014-06-18 00:00:00","2014-06-18 10:00:00",
        "2014-06-19 00:00:00","2014-06-19 10:00:00",
        "2014-06-20 00:00:00","2014-06-20 10:00:00",
        "2014-06-21 00:00:00","2014-06-21 10:00:00",
        "2014-06-22 00:00:00","2014-06-22 10:00:00",
        "2014-06-23 00:00:00","2014-06-23 10:00:00",
        "2014-06-23 22:00:00","2014-06-24 10:00:00",
        "2014-06-24 22:00:00","2014-06-25 10:00:00",
        "2014-06-25 22:00:00","2014-06-26 10:00:00",
        "2014-06-26 22:00:00","2014-06-27 10:00:00",
        "2014-06-28 22:00:00","2014-06-29 10:00:00",
        "2014-06-29 22:00:00","2014-06-30 10:00:00",
        "2014-06-30 22:00:00","2014-07-01 10:00:00",
        "2014-07-01 22:00:00","2014-07-02 10:00:00",
        "2014-07-04 22:00:00","2014-07-05 10:00:00",
        "2014-07-05 22:00:00","2014-07-06 10:00:00",
        "2014-07-09 10:00:00","2014-07-10 10:00:00",
        "2014-07-12 10:00:00","2014-07-14 02:00:00",
        "2014-07-14 10:00:00",
        );
$now = new DateTime();
$now->modify("+2 hours");

foreach($types as $key=>$value) {
  if(isset($_POST["matchbet_".$value])) {
    $type = $value;
    $matches=DbWrapper::getMatchesByType($type);
    foreach($matches as $match)
    {
      $gameId=$match->getGameId();
      $score1 = isset($_POST[$gameId."a"]) ? $_POST[$gameId."a"] : '';
      $score2 = isset($_POST[$gameId."b"]) ? $_POST[$gameId."b"] : '';
      $score1e = isset($_POST[$gameId."a2"]) ? $_POST[$gameId."a2"] : '';
      $score2e = isset($_POST[$gameId."b2"]) ? $_POST[$gameId."b2"] : '';

      $team1 = isset($_POST[$gameId."team1"]) ? $_POST[$gameId."team1"] : '';
      $team2 = isset($_POST[$gameId."team2"]) ? $_POST[$gameId."team2"] : '';

      if(($score1=="")||($score2==""))
        DbWrapper::setGameResult($gameId,-1,-1);
      else
        DbWrapper::setGameResult($gameId,$score1,$score2,$score1e,$score2e);
        
      if($team1 != '' || $team2 != '')
        DbWrapper::setGameTeams($gameId,$team1, $team2);
    }
  }
  if(isset($_POST["group_".$value]))
  {
      $groupTeams = DbWrapper::getTeamIDsByGroup($value);
      for ($i=0; $i<sizeof($groupTeams); $i++)
      {
        if(isset($_POST[$groupTeams[$i]."pos"]))
        {
          if($_POST[$groupTeams[$i]."pos"] == "")
            $pos = -1;
          else
            $pos = $_POST[$groupTeams[$i]."pos"];
          DbWrapper::updateTeamPositionById($groupTeams[$i], $pos);
        }
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
  $groupPoints[$userid] = 0;
  $winnerPoints[$userid] = 0;
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
      
    $game=  $matches[$userMatch["matchid"]];

    //history
    $gameTime = new DateTime($game->getTime());
    while(($historyCount<sizeof($historyDates)) && (new DateTime($historyDates[$historyCount]) < $now)) {
      //DbWrapper::updateScoreHistory($historyDates[$historyCount], $userid, $userPoints);
      $historyCount++;
    }
    if(isset($historyDates[$historyCount-1]))
      DbWrapper::updateScoreHistory($historyDates[$historyCount-1], $userid, $userPoints);

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
      //print($user->getName()." - ".$game->getFirstTeamGoals()." : ".$game->getSecondTeamGoals()."  getippt: ".$userMatch["goals1"]." : ".$userMatch["goals2"]." punkte: ".$userPoints."<br>");
    }
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
  if($user->getCupWinner() == 0) {
    $winnerPoints[$userid] += 5;
    $userPoints += 5;
  }

  if(isset($historyDates[$historyCount-1]))
    DbWrapper::updateScoreHistory($historyDates[$historyCount-1], $userid, $userPoints);
    
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