<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link type="text/css" rel="stylesheet"
	href="<?php print(Config::$absolute_url_path);?>templates/layout/style.css" />
<title>Pronostics coupe du monde 2014</title>
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
<div id="logo"><a href="<?php print(Config::$absolute_url_path);?>"><img alt="South Africa 2010"
	src="<?php print(Config::$absolute_url_path);?>templates/layout/logo.jpg"></a><br>
<!--img alt="Football players" style="margin-top: 180px;"
	src="<?php print(Config::$absolute_url_path);?>templates/layout/brasil.jpg"-->
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50952108-1', 'brevesdebureau.fr');
  ga('send', 'pageview');

</script>