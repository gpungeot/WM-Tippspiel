<?php
include_once (dirname(__FILE__)."/../../common.php");
Common::loginCheck();

if(Common::$user->getPassword()!=md5($_POST["password"])) {
	Common::modalMessage("Mot de passe incorrect", "profile.php");
} else {
	DbWrapper::setAsPayingUser(Common::$user->getUserId());
	Common::modalMessage("Tu fais désormais partie de la compétition. Si tu n'as pas encore payé ton obole... Ben fais-le.", "profile.php");
}
?>