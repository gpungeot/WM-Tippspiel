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
    $cookie="";
    if(isset($_COOKIE["TippSpiel"]))
      $cookie=$_COOKIE["TippSpiel"];
    if(($cookie!="")&&(!isset($_POST["mail"]) || !isset($_POST["password"])))
    {
      $parts=explode(":",$cookie);
      $id=$parts[0];
      $password=$parts[1];
      $user=DbWrapper::getUserById($id, Config::$siteid);
      if($user->getPassword()!=$password)
      {
        return null;
      }
    }
    else
    {//check for email password
      $user=null;
      if(isset($_POST["mail"]))
        $user=DbWrapper::getUserByEmail($_POST["mail"]);
      if($user==null)
      {
        return null;
      }
      else
        if($user->getPassword()!=md5($_POST["password"]))
        {
          return null;
        }
    }
    $newCookieContent=$user->getUserId().":".$user->getPassword();
    if(!headers_sent())
      setcookie("TippSpiel",$newCookieContent,time()+5184000,"/");
    self::$user=$user;
    return $user;
  }

  public static function disconnect()
  {
    $cookie="";
    setcookie("TippSpiel",$cookie,0,"/");
    self::redirect("pages/login.php");
  }

  
  public static function loginCheck()
  {
    self::$user=self::login();
    if(self::$user==NULL)
    {
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
      die("Pas de compte Admin");
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
    print($message);
    
    print("<a class=\"button\" href=\"".Config::$absolute_url_path."pages/".$page."\">OK</a>");
    print("</div>");
    self::endPage();
    die();
        
  }

}
?>