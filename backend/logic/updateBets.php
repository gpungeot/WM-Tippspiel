<?php
include_once (dirname(__FILE__)."/../../common.php");
Common::loginCheck();

$types = array("A","B","C","D","E","F","G","H","8Fin","4Fin","2Fin","3Fin","1Fin");
$userid = $_POST["userid"];
$type = $_POST["ALL"];
$groupBet = false;
$now = new DateTime();
$messages="";
if($_POST["winner"]) {
  $type = $value;
  if($_POST["worldcupwinner"]!="") {
    $messages="Champions du monde enregistrés. ";
    updateWinner();
  }
} else
if(!$type)
{
  foreach($types as $key=>$value) {
    if($_POST["matchbet_".$value]) {
      $type = $value;
      $messages="Pronostics pour ".$value." enregistrés. ";
      break;
    }
    if($_POST["group_".$value]) {
      $type = $value;
      $messages="Classement pour ".$value." enregistrés. ";
      $groupBet = true;
    }
  }
  if(!$groupBet) {
    updateMatchBets();
  } else {
    if(new DateTime($_POST[$type."firsttime"])>=$now) {
      updateGroupBets();
    } else Common::modalMessage("Trop tard... Les matches de ce groupes ont déjà commencé. ","profile.php");
  }
}
else {
  if(Time::getPrelimStart()>=$now) {
    updateWinner();
  }
  foreach($types as $key=>$value) {
    $type = $value;
    updateMatchBets();
    if(new DateTime($_POST[$type."firsttime"])>=$now) {
      updateGroupBets();
    }
  }
  Common::modalMessage("Enregistrement complet. ".$messages,"profile.php");
}

function updateWinner() {
  global $userid;
  $teamid = DbWrapper::getTeamIdByName($_POST["worldcupwinner"]);
  DbWrapper::updateWinnerBet($userid, $teamid);
}

function updateMatchBets() {
  global $now, $type, $userid, $messages;
  if($matches = DbWrapper::getMatchIDsByType($type))
  {
    //print_r($matches);
    foreach ($matches as $key=>$value) {
      $time = new DateTime($_POST[$value."time"]);
      if($time>=$now) {
        if($_POST[$value."a"]!="" && $_POST[$value."b"]!="") {
          $bets[$value] = new Score($_POST[$value."a"], $_POST[$value."b"]);
          DbWrapper::updateMatchBets($userid, $bets);
        }
      }
      else
      if($_POST[$value."a"])
        $messages.="Un des matches au moins à ".$time->format("H:i")." a commencé. ";
    }
  }
}

function updateGroupBets() {
  global $now, $type, $userid, $messages;
  if($teams = DbWrapper::getTeamIDsByGroup($type))
  {
    //check for collisions
    $collision = false;
    foreach ($teams as $key=>$value) {
      if($_POST[$value."pos"]!="") {
        if($set[$_POST[$value."pos"]] == true) {
          $collision = true;
          break;
        }
        else $set[$_POST[$value."pos"]] = true;
      }
    }

    //print_r($teams);
    if(!$collision) {
      foreach ($teams as $key=>$value) {
        if($_POST[$value."pos"]!="")
        $bets[$value] = $_POST[$value."pos"];
      }
      DbWrapper::updateGroupBets($userid, $bets);
    } else {
      $messages.="Position en double. Non enregistré.";
    }
  }
}

Common::modalMessage($messages,"profile.php#".$type);
?>