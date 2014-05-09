<?php
include_once (dirname(__FILE__)."/../common.php");

Common::loginCheck();
DbWrapper::connectToDatabase();
$userid = $_GET["user"];
$user = DbWrapper::getUserById($userid);
$result = DbWrapper::execute("SELECT COUNT(*) FROM `users`");
$arr = mysql_fetch_array($result);
$numberOfAllUsers = $arr[0];
if(!$userid || ($user->getUserId()==NULL)) {
	Common::modalMessage("Compte inconnu.", "ranking.php");
}
Common::startPage();
print("<h2>Pronostics de <i>".$user->getName()." ".$user->getSurname()."</i></h2>");
$history = DbWrapper::getUserHistory($userid);
$ranks = "";
foreach($history as $value) {
	$ranks .= $value[2].",";
}
print("<p>Verlauf:<br><img src=\"".Config::$absolute_url_path."pages/chartFactory.php?ranks=".$ranks."&max=".$numberOfAllUsers."\" style=\"border: 2px solid lightgray;\"></p>");
print("<span class=\"points\">Nombre de points : ".DbWrapper::getUserPoints($userid)."</span>");

$now = new DateTime();
$types = array("A"=>"Gruppe A", "B"=>"Groupe B", "C"=>"Groupe C", "D"=>"Groupe D", "E"=>"Groupe E", "F"=>"Groupe F",
				"G"=>"Groupe G", "H"=>"Groupe H", "8Fin"=>"1/8 finale", "4Fin"=>"1/4 finale", "2Fin"=>"1/2 finale",
				"3Fin"=>"3e place", "1Fin"=>"Finale");

$teams = DbWrapper::getAllTeams();
print("<div id=\"worldcupwinner\">Quelle équipe sera championne du monde ?");
print("<span class=\"viewbet\">");
print($user->getCupWinner()==0?"&nbsp;&nbsp;&nbsp;":DbWrapper::getTeamNameById($user->getCupWinner()));
print("</span>");
print("</div>");

foreach($types as $type=>$typetext)
{
	if($bets = DbWrapper::getMatchBetsByType($userid, $type)) {
		if(new DateTime($bets[0]->getTime())>$now) {
			break;
		}
		print("<a name=\"".$type."\">");
		print("<table><tr><td>");
		print("<table class=\"matchbets\">");
		print("<tr><td class=\"title\" colspan=6><h3>".$typetext."</h3></td></tr>");
		foreach($bets as $key=>$value)
		{
			$time = new DateTime($value->getTime());
			if($time<=$now) {
				print("<tr>");
				print("<td class=\"time\">".$time->format("d. M Y")."<br>".$time->format("H:i")."</td>");
				$team1 = $value->getFirstTeam();
				print("<td class=\"team\" style=\"text-align: right;\">");
				print($team1=="#"?"<i>Pas encore connu</i></td>":$team1."</td>");
				print("<td> : </td>");
				$team2 = $value->getSecondTeam();
				print("<td class=\"team\">");
				print($team2=="#"?"<i>Pas encore connu</i></td>":$team2."</td>");
				$score = $value->getBet();
				$pointsClass="";
				if($score) {
					$bet1 = $value->getBet()->getFirstTeamGoals();
					$bet2 = $value->getBet()->getSecondTeamGoals();
					if(($value->getResult()->getFirstTeamGoals()!=-1) && ($value->getResult()->getSecondTeamGoals()!=-1))
					{
						$result1=$value->getResult()->getFirstTeamGoals();
						$result2=$value->getResult()->getSecondTeamGoals();
						$points=0;
						if(
							(($result1==$result2)&&($bet1==$bet2))
							||
							(($result1>$result2)&&($bet1>$bet2))
							||
							(($result1<$result2)&&($bet1<$bet2)))
							$points++;
						if(($result1-$result2)==($bet1-$bet2))
							$points++;
						if(($result1==$bet1)&&($result2==$bet2))
							$points++;
						if($points>0)
							$pointsClass="points".$points;
					}
					
				} else {
					$bet1 = -1;
					$bet2 = -1;
				}
				print("<td class=\"viewbet $pointsClass\">");
				print($score==null?"&nbsp;&nbsp;":$bet1);
				print(" : ");
				print($score==null?"&nbsp;&nbsp;":$bet2);
				if($pointsClass!="")
					print("<span class=\"smallpoints\">$points</span>");
				print("</td>");
				if(($value->getResult()->getFirstTeamGoals()!=-1) && ($value->getResult()->getSecondTeamGoals()!=-1)) {
					print("<td>".$value->getResult()->getFirstTeamGoals()." : ".$value->getResult()->getSecondTeamGoals()."</td>");
					if($value->hasDifferentEndScore())
					{
						print("<td>(".$value->getEndResult()->getFirstTeamGoals()." : ".$value->getEndResult()->getSecondTeamGoals().")</td>");
					}	
				}
			}
		}
		print("</table>");
		print("</td><td>");
		$correctGroupWinner=0;
		$groupCorrect=0;
		$teams = DbWrapper::getTeamBetsByGroup($userid, $type);
		print("<table class=\"groupBets\">");
		if($teams) {
			print("<tr><td class=\"title\" colspan=6><h3>Positionierung</h3></td></tr>");
			foreach($teams as $key=>$value) {
				print("<tr><td class=\"team\">");
				print($value->getTeamName());
				print("</td>");
				$correct=false;
				if($value->getBetPosition()==$value->getRealPosition())
				{
					$groupCorrect++;
					$correct=true;						
				}
				if(($value->getRealPosition()<3)&&($value->getBetPosition()<3))
					$correctGroupWinner++;
				print("<td class=\"bet ".($correct?"points3":"")."\" >");
				print($value->getBetPosition()==-1?"&nbsp;&nbsp;&nbsp;":$value->getBetPosition());
				
				if($correct)
					print("<span class=\"smallpoints\">1</span>");
				if(Time::getPrelimEnd()<$now) {
					print("<td>".$value->getRealPosition()."</td>");
				}
				print("</tr>");
			}
		}
		
		if($correctGroupWinner==2)
		{
			print("<tr><td class=\"title\" colspan=6>Equipe qualifiée : + 1 Pt</td></tr>");
		}
		if($groupCorrect==4)
		{
			print("<tr><td class=\"title\" colspan=6>Groupe correct entièrement : + 1 Pt</td></tr>");
		}		
		print("</table>");
		print("</td></tr></table>");
	}
}
Common::endPage();
?>