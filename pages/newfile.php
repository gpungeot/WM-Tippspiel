<?php
include_once (dirname(__FILE__)."/../common.php");

Common::loginCheck();
Common::startPage();
DbWrapper::connectToDatabase();

print("<h1>Classement</h1>");

$users = DbWrapper::getUsers();
foreach($users as $user) {
	print($user->getMailAddress().", ");
}
Common::endPage();
?>