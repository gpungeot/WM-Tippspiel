<?php
include_once (dirname(__FILE__)."/../common.php");
Common::login();
Common::startPage();
?>
<form action="../backend/controller/login.php" method="post">
E-Mail
<input type="text" size="20" name="mail" maxlength="40"></input><br />
Passwort
<input type="password" size="20" name="password" maxlength="40"></input><br />
<button type="submit">OK</button>
</form>

<?php
print("Noch nicht angemeldet? <a href=\"".Config::$absolute_url_path."pages/register.php\">Hier</a> registrieren.");
Common::endPage();
?>