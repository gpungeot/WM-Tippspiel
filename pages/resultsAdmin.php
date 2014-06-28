<?php
include_once (dirname(__FILE__)."/../common.php");
Common::adminCheck();	

Common::startPage();



?>

<h1>Saisie résultats</h1>
<form action="select.htm"></form>
<?php

print("<form action=\"".Config::$absolute_url_path."/backend/controller/matchResultsController.php\" method=\"post\">");
$now = new DateTime();
$now->modify("+2 hours");
print($now->format("Y-m-d H:i:s")."<br>");
$types = array("A"=>"Groupe A", "B"=>"Groupe B", "C"=>"Groupe C", "D"=>"Groupe D", "E"=>"Groupe E", "F"=>"Groupe F",
				"G"=>"Groupe G", "H"=>"Groupe H", "8Fin"=>"1/8 finale", "4Fin"=>"1/4 finale", "2Fin"=>"1/2 finale",
				"3Fin"=>"3e place", "1Fin"=>"Finale");
$teams=DbWrapper::getAllTeamsAsHashTable();
foreach($types as $type=>$typetext)
{
	$matches = DbWrapper::getMatchesByType( $type);
	if($matches) {
		print("<table class=\"matchbets\">");
		print("<tr><td class=\"title\" colspan=6><h3>".$typetext."</h3></td></tr>");
		foreach($matches as $key=>$value)
		{
			/**
			 * @var Game $value   is a game
			 */
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
			$time->modify("+1 hours 45 minutes");
//			echo '<br/>time '.$time->format("d. M Y H:i");
//			echo ' vs now '.$now->format("d. M Y H:i");

			if($time>$now) {
				$over = false;
			}
			else {
				$over = true;
			}
			$team1 = $value->getFirstTeam();
			print("<td class=\"team\" style=\"text-align: right;\">");
			print($team1=="0"?"<i>Pas encore connu</i></td>":$teams[$team1]->getName()."</td>");
			print("<td> - </td>");
			$team2 = $value->getSecondTeam();
			print("<td class=\"team\">");
			print($team2=="0"?"<i>Pas encore connu</i></td>":$teams[$team2]->getName()."</td>");
			$score = $value->getScore();
			$endScore = $value->getEndScore();
			if($score) {
				$bet1 = $score->getFirstTeamGoals();
				$bet2 = $score->getSecondTeamGoals();
				
				
			} else {
				$bet1 = -1;
				$bet2 = -1;
			}
			
			if($endScore) 
			{
				$bet12 = $endScore->getFirstTeamGoals();
				$bet22 = $endScore->getSecondTeamGoals();
			}
			else 
			{
				$bet12 = -1;
				$bet22 = -1;
			}
			if($over) {
				print("<td class=\"betdrop\">");
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
				
				print("<td class=\"betdrop\">");
				print("<select name=\"".$value->getGameId()."a2\" size=1>");
				print("<option");
				print($endScore==null?" selected":"");				
				print("></option>");
				for ($i=0; $i<13; $i++) {
					print("<option");
					print($bet12==$i?" selected":"");
					print(">".$i."</option>");
				}
				print("</select>");
				print(" - ");
				print("<select name=\"".$value->getGameId()."b2\" size=1>");
				print("<option");
				print($endScore==null?" selected":"");
				print("></option>");
				for ($i=0; $i<13; $i++) {
					print("<option");
					print($bet22==$i?" selected":"");
					print(">".$i."</option>");
				}
				print("</select>");
				print("</td>");
				
			} else {
				print("<td class=\"betdrop\">");
				print("</td>");
			}
			if(!$over) {
				print("<td>Saisir après ".$time->format("d. M Y H:i")."</td>");
			}
		}
		print("<tr><td colspan=5 class=\"savebtn\"><h3>");
		print("<input type=\"submit\" value=\"Enregistrer\" name=\"matchbet_".$type."\">");
		print("</h3></td></tr>");
		print("</table>");

		
		
	}
}
print("<input type=\"submit\" value=\"Enregistrer tout\" name=\"ALL\">");
print("</form>");