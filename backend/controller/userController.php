<?php
	include_once(dirname(__FILE__)."/../../common.php");
	Common::loginCheck();
	
	$id=$_POST["user"];
	if($_POST["action"]=="acceptUser")
	{
		$user=DbWrapper::getUserById($id);
		@mail($user->getMailAddress(),"Pronos coupe du monde 2014","Compte validé. Go ! Go ! Go ! : ".Config::$absolute_url_path);
		DbWrapper::acceptUser($id);
		
	}
	
	if($_POST["action"]=="rejectUser")
	{
		$user=DbWrapper::getUserById($id);
		@mail($user->getMailAddress(),"Pronos coupe du monde 2014","C'est un jeu privé, désolé.");
		DbWrapper::deleteUser($id);
	}
	
	Common::redirect("pages/userAdmin.php");
?>
