<?php
include_once (dirname(__FILE__)."/../../common.php");
Common::loginCheck();

if(Common::$user->getPassword()!=md5($_POST["password"])) {
	Common::modalMessage("Du hast ein falsches Passwort eingegeben.", "profile.php");
} else {
	DbWrapper::setAsPayingUser(Common::$user->getUserId());
	Common::modalMessage("Jetzt hast du die Möglichkeit einen tollen Preis zu ergattern! (Bitte bezahle die 3 Euro bei nächster Gelegenheit)", "profile.php");
}
?>