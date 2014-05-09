<?php
include_once (dirname(__FILE__)."/../common.php");
Common::adminCheck();	

Common::startPage();
	
	$notRegisteredUsers=DbWrapper::getUserRequests();
	print("<h2>Validation comptes</h2>");
	foreach($notRegisteredUsers as $user)
	{
		print("<div class='userRequest'>");
		
		print("<form action='../backend/controller/userController.php' method='post'><input type='hidden' name='user' value='".htmlentities($user->getUserId())."' />");
		print("<p>".htmlentities($user->getName())." ".htmlentities($user->getSurname())."</p>");
		print("<p>".htmlentities($user->getMailAddress())."</p>");
		print("<button name='action' value='acceptUser' type='submit'>Valider</button>");
		print("<button name='action' value='rejectUser' type='submit'>refuser</button>");
		print("</form>");
		print("<div>");
	}
	
	
	$allUsers=DbWrapper::getUsers();
	print("<h2>Acceptés</h2>");
	print("<table>");
	foreach($allUsers as $user)
	{
		if($user->isAccepted())
			print("<tr><td>".htmlentities($user->getName())." ".htmlentities($user->getSurname())."</td><td>".htmlentities($user->getMailAddress())."</td></tr>");
	}
	print("</table>");
	Common::endPage();
?>