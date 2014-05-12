<?php
	include_once(dirname(__FILE__)."/../../common.php");
	Common::loginCheck();
	
	$id=$_POST["user"];
	if($_POST["action"]=="acceptUser")
	{
		$user=DbWrapper::getUserById($id);
		$header = "From: \"Brasil world cup\"<noreply@brevesdebureau.fr>";
		@mail($user->getMailAddress(),"Pronos coupe du monde 2014","Compte validé. Go ! Go ! Go ! : ".Config::$absolute_url_path, $header);
		DbWrapper::acceptUser($id);
		
	}
	
	if($_POST["action"]=="rejectUser")
	{
		$user=DbWrapper::getUserById($id);
		$header = "From: \"Brasil world cup\"<noreply@brevesdebureau.fr>";
		@mail($user->getMailAddress(),"Pronos coupe du monde 2014 - Inscription refusée","C'est un jeu privé, désolé.", $header);
		DbWrapper::deleteUser($id);
	}
	
	Common::redirect("pages/userAdmin.php");
?>
