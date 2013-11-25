<?php
include_once (dirname(__FILE__)."/../common.php");
Common::adminCheck();	

Common::startPage();



?>

<h1>Ergebniseingabe</h1>
<form action="select.htm"></form>
<?php

print("<form action=\"".Config::$absolute_url_path."/backend/controller/matchResultsController.php\" method=\"post\">");
$now = new DateTime();
print($now->format("Y-m-d H:i:s")."<br>");
$types = array("A"=>"Gruppe A", "B"=>"Gruppe B", "C"=>"Gruppe C", "D"=>"Gruppe D", "E"=>"Gruppe E", "F"=>"Gruppe F",
				"G"=>"Gruppe G", "H"=>"Gruppe H", "8Fin"=>"Achtelfinale", "4Fin"=>"Viertelfinale", "2Fin"=>"Halbfinale",
				"3Fin"=>"Spiel um Platz 3", "1Fin"=>"Finale");
$teams=DbWrapper::getAllTeamsAsHashTable();
foreach($types as $type=>$typetext)
{
	$matches = DbWrapper::getMatchesByType( $type);
	//print_r($matches);
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
			if($time>$now) {
				$over = false;
			}
			else {
				$over = true;
			}
			$team1 = $value->getFirstTeam();
			print("<td class=\"team\" style=\"text-align: right;\">");
			print($team1=="0"?"<i>noch nicht fest</i></td>":$teams[$team1]->getName()."</td>");
			print("<td> : </td>");
			$team2 = $value->getSecondTeam();
			print("<td class=\"team\">");
			print($team2=="0"?"<i>noch nicht fest</i></td>":$teams[$team2]->getName()."</td>");
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
				print(" : ");
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
				print(" : ");
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
				//print($score==null?"":$bet1);
				//print(" : ");
				//print($score==null?"":$bet2);
				print("</td>");
			}
			if(!$over) {
				print("<td> Eintragen ab ".$time->format("d. M Y H:i")."</td>");
			}
		}
		print("<tr><td colspan=5 class=\"savebtn\"><h3>");
		print("<input type=\"submit\" value=\"Speichern\" name=\"matchbet_".$type."\">");
		print("</h3></td></tr>");
		print("</table>");

		
		
	}
}
print("<input type=\"submit\" value=\"Alle Änderungungen speichern\" name=\"ALL\">");
print("</form>");