<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" rel="stylesheet"
	href="<?php print(Config::$absolute_url_path);?>templates/layout/style.css" />
<title>Pronostics coupe du monde 2014 - CanalTP</title>
</head>
<body>
<?php
//<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
print("<div id=\"page\">");
print("<div class=\"menu\">");
if(Common::isAdmin())
{
	print("<a href=\"".Config::$absolute_url_path."pages/userAdmin.php\">Utilisateurs</a>");
	print("  ::  ");
	print("<a href=\"".Config::$absolute_url_path."pages/resultsAdmin.php\">Enregistrer des résultats</a>");
	print("  ::  ");
	print("<a href=\"".Config::$absolute_url_path."pages/login.php\">Login</a>");
}
if(Common::$user!=null) {
	print("<a href=\"".Config::$absolute_url_path."pages/rules.php\">Règles du jeu</a>");
	print("<a href=\"".Config::$absolute_url_path."pages/ranking.php\">Classement</a>");
	print("<a href=\"".Config::$absolute_url_path."pages/profile.php\">Mes pronostics [<i>".Common::$user->getName()." ".Common::$user->getSurname()."</i>]</a>");
}
print("</div>");

?>
<div id="logo"><img alt="South Africa 2010"
	src="<?php print(Config::$absolute_url_path);?>templates/layout/logo.jpg"><br>
<img alt="Football players" style="margin-top: 180px;"
	src="<?php print(Config::$absolute_url_path);?>templates/layout/kickers.png">
</div>