<?php
include_once('../../common.php');
print(DbWrapper::connectToDatabase());

// table queries
$tables = array();
$tables["users"] = "`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` CHAR(64) NOT NULL, 
					`surname` CHAR(64) NOT NULL, `password` CHAR(40) NOT NULL,
					`email` CHAR(64) NOT NULL, `cupwinner` INT(10) NOT NULL,`points` INT(10),
					`accepted` TINYINT";
$tables["teams"] = "`id` INT(10) UNSIGNED NOT NULL PRIMARY KEY,
					`name` CHAR(64) NOT NULL,`gruup` CHAR(1) NOT NULL,
					`position` TINYINT NOT NULL";
$tables["matches"] = "`id` INT(10) UNSIGNED NOT NULL PRIMARY KEY, `type` CHAR(4) NOT NULL,
					`time` DATETIME NOT NULL, `team1` INT(10) NOT NULL, 
					`team2` INT(10) NOT NULL, `goals1` TINYINT, `goals2` TINYINT";
$tables["matchBets"] = "`userid` INT(10) NOT NULL, `matchid` INT(10) NOT NULL,
					`goals1` TINYINT, `goals2` TINYINT";
$tables["groupBets"] = "`userid` INT(10) NOT NULL, `teamid` INT(10) NOT NULL,
					`position` TINYINT NOT NULL";
$tables["score"] = "`time` DATETIME NOT NULL, `userid` INT(10) NOT NULL,
					`points` INT(10)";

// create tables
print(DbWrapper::createTables($tables));
$user=new User(1,"Admin","istrator","","Admin");
DbWrapper::addUser($user);
print('OK');
?>