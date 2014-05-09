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
	$message .= "<b>Mot de passe</b> obligatoire.<br>";
}
if($pw != $pwcopy) {
	$valid = false;
	$message .= "La <b>confirmation du mot de passe</b> est incorrecte.<br>";
}
if($name == null) {
	$valid = false;
	$message .= "<b>Prénom</b> obligatoire (mais tu peux mentir).<br>";
}
if($surname == null) {
	$valid = false;
	$message .= "<b>Nom</b> obligatoire (mais tu peux mentir).<br>";
}
if(($mail == null) || (strpos($mail, "@")==false)) {
	$valid = false;
	$message .= "<b>Adresse email</b> incorrecte.<br>";
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