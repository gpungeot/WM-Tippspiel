<?php
include_once (dirname(__FILE__)."/../common.php");

Common::loginCheck();
Common::startPage();
DbWrapper::connectToDatabase();

print("<h1>Classement</h1>");

$users = DbWrapper::getRanking(); //userid->(name, points) sorted by points desc
$history = DbWrapper::getLatestScoreHistory(); //userid->(points, position)

print("<table>");
$i = 1; //increments when score differs
$j = 1; //increments always
$oldscore = -1;
foreach($users as $user=>$value) {
	print("<tr><td class=\"rank\">");
	if($oldscore != $value[1]) {
		$i = $j;
		print($i);
	}
	print("</td>");
	if($i > $history[$user][1]) {
		print("<td class=\"rankDown\">");
		print("</td>");
	}
	else if($i == $history[$user][1]) {
		print("<td class=\"rankEqual\">");
		print("</td>");
	}
	else if($i < $history[$user][1]) {
		print("<td class=\"rankUp\">");
		print("</td>");
	}
	print("<td class=\"");
	print(Common::$user->getUserId()==$user?"myname":"name");
	print("\"><a href=\"".Config::$absolute_url_path."pages/view.php?user=".$user."\">".$value[0]."</a></td><td class=\"bet\">".$value[1]." Points</td>");
	
	print("</tr>");
	//print("(".$user.":".$history[$user][1].")");
	$j++;
	$oldscore = $value[1];
}
print("</table>");
Common::endPage();
?>