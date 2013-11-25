<?php
include_once (dirname(__FILE__)."/../../common.php");
$dblink = mysql_connect(Config::$mysql_path, Config::$mysql_user, Config::$mysql_password);
mysql_query("ALTER TABLE `matches` ADD COLUMN `realgoal1` TINYINT",$dblink);
mysql_query("ALTER TABLE `matches` ADD COLUMN `realgoal2` TINYINT",$dblink);
$e = mysql_error($dblink);
print($e?$e:"Spalten 'realgoal1' und 'realgoal2' wurde zu 'matches' hinzugefügt.");
?>