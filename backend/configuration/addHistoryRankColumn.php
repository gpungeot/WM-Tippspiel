<?php
include_once (dirname(__FILE__)."/../../common.php");
$dblink = mysql_connect(Config::$mysql_path, Config::$mysql_user, Config::$mysql_password);
mysql_query("ALTER TABLE `score` ADD COLUMN `rank` INT(10)",$dblink);
$e = mysql_error($dblink);
print($e?$e:"Champ 'rank' ajouté à la table 'score'.");
?>