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
$all_teams=DbWrapper::getAllTeams();
foreach($types as $type=>$typetext)
{
  $matches = DbWrapper::getMatchesByType( $type);
  if($matches) {
		print("<table><tr><td>");
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
      $team2 = $value->getSecondTeam();
      print("<td class=\"team\" style=\"text-align: right;\">");
      
      if($type >= 'A')
      {
        // Groups
        print($team1=="0"?"<i>Pas encore connu</i></td>":$teams[$team1]->getName()."</td>");
        print("<td> - </td>");
        print("<td class=\"team\">");
        print($team2=="0"?"<i>Pas encore connu</i></td>":$teams[$team2]->getName()."</td>");
      }
      else
      {
        // 1/8Fin and after
        print("<select name=\"".$value->getGameId()."team1\">");
        print("<option value=\"0\"".($team1 == "0" ? " selected=\" \"" : ""));
        print("> </option>");
        for ($i=0; $i<sizeof($all_teams); $i++) {
          print("<option value=\"".$all_teams[$i]->getTeamId()."\"");
          print($all_teams[$i]->getTeamId()==$team1?" selected=\"".$all_teams[$i]->getName()."\"":"");
          print(">".$all_teams[$i]->getName()."</option>");
        }
        print("</select></td>");

        print("<td> - </td>");
        print("<td class=\"team\">");

        print("<select name=\"".$value->getGameId()."team2\">");
        print("<option value=\"0\"".($team2 == "0" ? " selected=\" \"" : ""));
        print("> </option>");
        for ($i=0; $i<sizeof($all_teams); $i++) {
          print("<option value=\"".$all_teams[$i]->getTeamId()."\"");
          print($all_teams[$i]->getTeamId()==$team2?" selected=\"".$all_teams[$i]->getName()."\"":"");
          print(">".$all_teams[$i]->getName()."</option>");
        }
        print("</select></td>");
      }
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
    print("</td><td>");
  }

    if($type >= 'A')
    {
        // Positions in groups
        $groupTeams = DbWrapper::getTeamIDsByGroup($type);
        print("<table class=\"groupBets\">");
        if($groupTeams) {
        	print("<tr><td class=\"title\" colspan=6><h3>Classement groupe</h3></td></tr>");
        	foreach($groupTeams as $key=>$value) {
        		print("<tr><td class=\"team\">");
        		print(DbWrapper::getTeamNameById($value));
        		print("</td>");
        		print("<td class=\"bet\">");
        		print("<select name=\"".$value."pos\">");
        		print("<option");
        		print(DbWrapper::getTeamPositionById($value)==-1?" selected":"");
        		print("></option>");
        		for ($i=1; $i<=sizeof($groupTeams); $i++) {
        			print("<option");
        			print(DbWrapper::getTeamPositionById($value)==$i?" selected":"");
        			print(">".$i."</option>");
        		}
        		print("</select>");
        		print("</td></tr>");
        	}
        	print("<tr><td colspan=3 class=\"savebtn\"><h3>");
        	print("<input type=\"submit\" value=\"Enregistrer\" name=\"group_".$type."\">");
        	print("</h3></td></tr>");
        }
    }
    print("</table>");
		print("</td></tr></table>");
}
print("<input type=\"submit\" value=\"Enregistrer tout\" name=\"ALL\">");
print("</form>");