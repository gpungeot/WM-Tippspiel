<?php
$path = $_POST["path"];
$pw = $_POST["password"];
$pwcopy = $_POST["pwcopy"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$mail = $_POST["emailaddress"];

include_once (dirname(__FILE__)."/../../common.php");

$valid = true;
$message = "";

if($pw == null) {
	$valid = false;
	$message .= "Du brauchst ein <b>Passwort</b>, um mitmachen zu können.<br>";
}
if($pw != $pwcopy) {
	$valid = false;
	$message .= "Dein <b>wiederholtes Passwort</b> ist unterschiedlich.<br>";
}
if($name == null) {
	$valid = false;
	$message .= "Du musst deinen <b>Vornamen</b> angeben.<br>";
}
if($surname == null) {
	$valid = false;
	$message .= "Gib bitte deinen <b>Nachnamen</b> an.<br>";
}
if(($mail == null) || (strpos($mail, "@")==false)) {
	$valid = false;
	$message .= "Wir benötigen eine gültige <b>eMail-Adresse</b>, um dich freizuschalten.<br>";
}

if(!$valid) {
	print("<div>".$message."</div>");
	$path .= "?name=".$name."&surname=".$surname."&mail=".$mail;
	Common::redirect($path);
}
else {
	//$user = new User("9", "Jon", "Jon", "Foreman", "friendofthefoot", "jon@switchfoot.com", "0");
	$user = new User("0",  $name, $surname, $pw, $mail, "0");
	DbWrapper::addUser($user);

	Common::redirect("pages/confirmation.php");
}



?>