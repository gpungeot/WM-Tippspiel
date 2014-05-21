<?php
include_once (dirname(__FILE__)."/../common.php");
Common::login();
if(Common::$user!=null)
  Common::disconnect();
Common::startPage();
?>
<form action="../backend/controller/login.php" method="post">
E-Mail
<input type="text" size="20" name="mail" maxlength="40"></input><br />
Mot de passe
<input type="password" size="20" name="password" maxlength="40"></input><br />
<button type="submit">OK</button>
</form>

<?php
print("Pas encore inscrit(e) ? C'est là : <a href=\"".Config::$absolute_url_path."pages/register.php\">inscription</a>.");
Common::endPage();
?>