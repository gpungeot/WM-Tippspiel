<?php
include_once (dirname(__FILE__)."/../../common.php");
$dblink = mysql_connect(Config::$mysql_path, Config::$mysql_user, Config::$mysql_password);
mysql_query("ALTER TABLE `matches` ADD COLUMN `realgoal1` TINYINT",$dblink);
mysql_query("ALTER TABLE `matches` ADD COLUMN `realgoal2` TINYINT",$dblink);
$e = mysql_error($dblink);
print($e?$e:"Champs 'realgoal1' et 'realgoal2' ajoutés à la table 'matches'.");
?>