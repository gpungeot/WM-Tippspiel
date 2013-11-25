<?php



include_once(dirname(__FILE__).'/backend/configuration/config.php');
include_once(dirname(__FILE__).'/backend/configuration/dbWrapper.php');
include_once(dirname(__FILE__).'/backend/configuration/time.php');
include_once(dirname(__FILE__).'/backend/user.php');
include_once(dirname(__FILE__).'/backend/objects.php');
DbWrapper::connectToDatabase();
class Common{
	public static $user=NULL;
	
	public static function startPage()
	{
		include(dirname(__FILE__)."/templates/startPage.php");
	}
	
	public static function endPage()
	{
		include(dirname(__FILE__)."/templates/endPage.php");
	}
	
	public static function login()
	{		
		if(self::$user!=NULL)
			return self::$user;
		//print("login ");
		//print_r($_COOKIE);
		$cookie=$_COOKIE["TippSpiel"];
		if(($cookie!="")&&(!isset($_POST["mail"]) || !isset($_POST["password"])))
		{
			//print("login with cookie");
			$parts=split(":",$cookie);
			$id=$parts[0];
			$password=$parts[1];
			$user=DbWrapper::getUserById($id);
			//print($id." - ".$password." [".$cookie."] ".$user->getPassword());
			if($user->getPassword()!=$password)
			{
				return null;
			}		
		}
		else
		{//check for email password 
			$user=DbWrapper::getUserByEmail($_POST["mail"]);
			if($user==null)
			{
				//print("no user with mail " . $_POST["mail"]);
				return null;
			}
			else
				if($user->getPassword()!=md5($_POST["password"]))
				{
					//print("wrong pw " . $_POST["password"]);
					return null;
				}	
		}
		$newCookieContent=$user->getUserId().":".$user->getPassword();
		if(!headers_sent())		
			setcookie("TippSpiel",$newCookieContent,time()+3600,"/");
		self::$user=$user;
		return $user;
	}
	
	
	public static function loginCheck()
	{
		self::$user=self::login();
		if(self::$user==NULL)
		{
			//die("Nicht eingeloggt ");
			self::redirect("pages/login.php");
			die();
		}
		else
			return true;
	}
	
	public static function isAdmin()
	{
		self::$user=self::login();
		if(self::$user==NULL)
			return false;
		return self::$user->getMailAddress()=="Admin";
	}
	
	public static function adminCheck()
	{
		
		if(!self::isAdmin())
			die("kein Admin");
		else
			return true;
	}
	
	public static function redirect($relativePath)
	{
		$destination=Config::$absolute_url_path.$relativePath;
		if(!headers_sent())
		{
			header("Location: $destination");
		}
		 else
		 {
		 	print("<a href=\"$destination\">".htmlentities($destination)."</a>");
		 }
	}
	
	public static function modalMessage($message,$page)
	{
		self::startPage();
		print("<div class=\"message\">");
		print(htmlentities($message));
		
		print("<a class=\"button\" href=\"".Config::$absolute_url_path."pages/".$page."\">OK</a>");
		print("</div>");
		self::endPage();
		die();
				
	}

}
?>