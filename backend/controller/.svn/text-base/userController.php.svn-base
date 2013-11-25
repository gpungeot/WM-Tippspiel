<?php
	include_once(dirname(__FILE__)."/../../common.php");
	Common::loginCheck();
	
	$id=$_POST["user"];
	if($_POST["action"]=="acceptUser")
	{
		$user=DbWrapper::getUserById($id);
		@mail($user->getMailAddress(),"WM Tippspiel","Du kannst jetzt bei unserem Tippspiel mitmachen: ".Config::$absolute_url_path);
		DbWrapper::acceptUser($id);
		
	}
	
	if($_POST["action"]=="rejectUser")
	{
		$user=DbWrapper::getUserById($id);
		@mail($user->getMailAddress(),"WM Tippspiel","Du darfst leider nicht mitspielen");
		DbWrapper::deleteUser($id);
	}
	
	Common::redirect("pages/userAdmin.php");
?>
