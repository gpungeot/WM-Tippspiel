<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=encoding">
<link type="text/css" rel="stylesheet"
	href="<?php print(Config::$absolute_url_path);?>templates/layout/style.css" />
<title>WM Tippspiel</title>
</head>
<body>
<?php
//<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
print("<div id=\"page\">");
print("<div class=\"menu\">");
if(Common::isAdmin())
{
	print("<a href=\"".Config::$absolute_url_path."pages/userAdmin.php\">Benutzerverwaltung</a>");
	print("  ::  ");
	print("<a href=\"".Config::$absolute_url_path."pages/resultsAdmin.php\">Ergebnisse Eintragen</a>");
	print("  ::  ");
	print("<a href=\"".Config::$absolute_url_path."pages/login.php\">Login</a>");
}
if(Common::$user!=null) {
	print("<a href=\"".Config::$absolute_url_path."pages/rules.php\">Spielregeln</a>");
	print("<a href=\"".Config::$absolute_url_path."pages/ranking.php\">Punktestand</a>");
	print("<a href=\"".Config::$absolute_url_path."pages/profile.php\">Meine Tipps [<i>".Common::$user->getName()." ".Common::$user->getSurname()."</i>]</a>");
}
print("</div>");

?>
<div id="logo"><img alt="South Africa 2010"
	src="<?php print(Config::$absolute_url_path);?>templates/layout/logo.jpg"><br>
<img alt="Football players" style="margin-top: 180px;"
	src="<?php print(Config::$absolute_url_path);?>templates/layout/kickers.png">
<p><strong><i>Neu:</i> Der Weltmeistertipp wurde gewertet.</strong></p>
<p><i>Neu:</i> Die Gruppentipps wurden ausgewertet!!!</p>


</div>