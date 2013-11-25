<?php
include_once (dirname(__FILE__)."/../../common.php");
$dblink = mysql_connect(Config::$mysql_path, Config::$mysql_user, Config::$mysql_password);
mysql_query("ALTER TABLE `users` ADD COLUMN `paying` TINYINT NOT NULL",$dblink);
$e = mysql_error($dblink);
print($e?$e:"Spalte 'paying' wurde zu 'users' hinzugefügt.");
?>