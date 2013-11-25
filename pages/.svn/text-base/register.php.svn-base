<?php
include_once (dirname(__FILE__)."/../common.php");
Common::login();

Common::startPage();
$name = $_GET["name"];
$surname = $_GET["surname"];
$mail = $_GET["mail"];
?>
<h1>Anmeldung</h1>
<form name="Registration"
	action="<?php print(Config::$absolute_url_path)?>backend/logic/validateRegistration.php"
	method="post"> 
<input name="path" type="hidden" value="pages/register.php">
<table cellspacing="20">
	<tr>
		<td>Email:</td>
		<td><input name="emailaddress" type="text" size="64" maxlength="64" value="<?php print($mail?$mail:"");?>"></td>
	</tr>
	<tr>
		<td>Passwort:</td>
		<td><input name="password" type="password" size="64" maxlength="40"></td>
	</tr>
	<tr>
		<td>Passwort wiederholen:</td>
		<td><input name="pwcopy" type="password" size="64" maxlength="40"></td>
	</tr>
	<tr>
		<td><br>
		</td>
	</tr>
	<tr>
		<td>Vorname:</td>
		<td><input name="name" type="text" size="64" maxlength="64" value="<?php print($name?$name:"");?>"></td>
	</tr>
	<tr>
		<td>Nachname:</td>
		<td><input name="surname" type="text" size="64" maxlength="64" value="<?php print($surname?$surname:"");?>"></td>
	</tr>
	
	<tr>
		<td colspan="2"><input type="submit" value="Anmelden"
			style="height: 30px; float: right;"></td>
	</tr>
</table>
</form>
<?php 
Common::endPage();
?>
