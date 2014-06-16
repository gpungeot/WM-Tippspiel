<?php
include_once (dirname(__FILE__)."/../common.php");

Common::loginCheck();
Common::startPage();
DbWrapper::connectToDatabase();
?>
<h1>Pronostics</h1>
<?php
$userid = Common::$user->getUserId();
//print("<span class=\"points\">Nombre de points : ".DbWrapper::getUserPoints($userid)."</span>");

if(!DbWrapper::isPayingUser($userid)) {
	print("<div class=\"message\" style=\"margin-left: 35px; background-color: #FFFF9B;\">");
	print("<form action=\"".Config::$absolute_url_path."/backend/logic/payingUser.php\" method=\"post\">");
	print("<p>Si tu as le démon du jeu, donne 5€ à Guillaume P pour participer au challenge payant. Saisis ton mot de passe ci-dessous pour le confirmer.</p>");
	print("<input type=\"password\" name=\"password\" size=\"20\" maxlength=\"64\">");
	print("<input type=\"submit\" value=\"J'ai le vice chevillé au corps, je paie !\">");
	print("</form></div>");
}

print("<form action=\"".Config::$absolute_url_path."/backend/logic/updateBets.php\" method=\"post\">");
print("<input type=\"hidden\" name=\"userid\" value=\"".$userid."\">");
$now = new DateTime();
$now->modify("+2 hours");
$types = array("A"=>"Groupe A", "B"=>"Groupe B", "C"=>"Groupe C", "D"=>"Groupe D", "E"=>"Groupe E", "F"=>"Groupe F",
				"G"=>"Groupe G", "H"=>"Groupe H", "8Fin"=>"1/8 finale", "4Fin"=>"1/4 finale", "2Fin"=>"1/2 finale",
				"3Fin"=>"3e place", "1Fin"=>"Finale");

$teams = DbWrapper::getAllTeams();
print("<div id=\"worldcupwinner\">Quelle équipe sera championne du monde ?");
if(Time::getPrelimStart()>$now) {
	print("<select name=\"worldcupwinner\">");
	print("<option");
	print("></option>");
	for ($i=0; $i<sizeof($teams); $i++) {
		print("<option");
		print($teams[$i]->getTeamId()==Common::$user->getCupWinner()?" selected":"");
		print(">".$teams[$i]->getName()."</option>");
	}
	print("</select>");
	print("<input type=\"submit\" value=\"Enregistrer\" name=\"winner\">");
} else {
	print("<span class=\"bet\">");
	print(Common::$user->getCupWinner()==0?"&nbsp;&nbsp;&nbsp;":DbWrapper::getTeamNameById(Common::$user->getCupWinner()));
	print("</span>");
	if(Time::getWorldCupEnd()<$now) {
		//print(winner);
	}
}
print("</div>");

foreach($types as $type=>$typetext)
{
	if($bets = DbWrapper::getMatchBetsByType($userid, $type)) {
		print("<a name=\"".$type."\">");
		print("<input type=\"hidden\" name=\"".$type."firsttime\" value=\"".$bets[0]->getTime()."\">");
		print("<table><tr><td>");
		print("<table class=\"matchbets\">");
		print("<tr><td class=\"title\" colspan=6><h3>".$typetext."</h3></td></tr>");
		foreach($bets as $key=>$value)
		{
			$time = new DateTime($value->getTime());
			if($time>$now) {
				$started = false;
			}
			else {
				$started = true;
			}
			print("<tr>");
			print("<input type=\"hidden\" name=\"".$value->getGameId()."time\" value=\"".$value->getTime()."\">");
			print("<td class=\"time\">".$time->format("d. M Y")."<br>".$time->format("H:i")."</td>");
			$team1 = $value->getFirstTeam();
			print("<td class=\"team\" style=\"text-align: right;\">");
			print($team1=="#"?"<i>Pas encore connu</i></td>":$team1."</td>");
			print("<td> - </td>");
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
			if(!$started) {
				print("<td class=\"bet\">");
				print("<select name=\"".$value->getGameId()."a\" size=1>");
				print("<option");
				print($score==null?" selected":"");
				print("></option>");
				for ($i=0; $i<13; $i++) {
					print("<option");
					print($bet1==$i?" selected":"");
					print(">".$i."</option>");
				}
				print("</select>");
				print(" - ");
				print("<select name=\"".$value->getGameId()."b\" size=1>");
				print("<option");
				print($score==null?" selected":"");
				print("></option>");
				for ($i=0; $i<13; $i++) {
					print("<option");
					print($bet2==$i?" selected":"");
					print(">".$i."</option>");
				}
				print("</select>");
				print("</td>");
			} else {
				print("<td class=\"bet $pointsClass\">");
				print($score==null?"&nbsp;&nbsp;":$bet1);
				print(" - ");
				print($score==null?"&nbsp;&nbsp;":$bet2);
				if($pointsClass!="")
					print("<span class=\"smallpoints\">$points</span>");
				print("</td>");
			}
			if(($value->getResult()->getFirstTeamGoals()!=-1) && ($value->getResult()->getSecondTeamGoals()!=-1)) {
				print("<td>".$value->getResult()->getFirstTeamGoals()." - ".$value->getResult()->getSecondTeamGoals()."</td>");
				if($value->hasDifferentEndScore())
				{
					print("<td>(".$value->getEndResult()->getFirstTeamGoals()." - ".$value->getEndResult()->getSecondTeamGoals().")</td>");
				}				
			}
			
		}
		print("<tr><td colspan=5 class=\"savebtn\"><h3>");
		print("<input type=\"submit\" value=\"Enregistrer\" name=\"matchbet_".$type."\">");
		print("</h3></td></tr>");
		print("</table>");
		print("</td><td>");

		$teams = DbWrapper::getTeamBetsByGroup($userid, $type);
		$correctGroupWinner=0;
		$groupCorrect=0;
		print("<table class=\"groupBets\">");
		if($teams) {
			print("<tr><td class=\"title\" colspan=6><h3>Classement groupe</h3></td></tr>");
			if(new DateTime($bets[0]->getTime())>$now) {
				foreach($teams as $key=>$value) {
					print("<tr><td class=\"team\">");
					print($value->getTeamName());
					print("</td>");
					print("<td class=\"bet\">");
					print("<select name=\"".$value->getTeamId()."pos\">");
					print("<option");
					print($value->getBetPosition()==-1?" selected":"");
					print("></option>");
					for ($i=1; $i<=sizeof($teams); $i++) {
						print("<option");
						print($value->getBetPosition()==$i?" selected":"");
						print(">".$i."</option>");
					}
					print("</select>");
					print("</td></tr>");
				}
				print("<tr><td colspan=3 class=\"savebtn\"><h3>");
				print("<input type=\"submit\" value=\"Enregistrer\" name=\"group_".$type."\">");
				print("</h3></td></tr>");
			} else {
				
				
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
					print("</td>");
					if(Time::getPrelimEnd()<$now) {
						print("<td>".$value->getRealPosition()."</td>");
					}
					print("</tr>");
				}
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
print("<input id=\"saveAll\" type=\"submit\" value=\"Tout enregistrer\" name=\"ALL\">");
print("</form>");
Common::endPage();
?>