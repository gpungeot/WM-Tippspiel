<?php
include_once('../../common.php');
print(DbWrapper::connectToDatabase());

function setUpTeams() {
	DbWrapper::addTeam(new Team("0", "#", "0", "0"));
	DbWrapper::addTeam(new Team("1", "Brésil", "A", "1"));
	DbWrapper::addTeam(new Team("2", "Croatie", "A", "-1"));
	DbWrapper::addTeam(new Team("3", "Mexique", "A", "-1"));
	DbWrapper::addTeam(new Team("4", "Cameroun", "A", "-1"));

	DbWrapper::addTeam(new Team("5", "Espagne", "B", "-1"));
	DbWrapper::addTeam(new Team("6", "Pays Bas", "B", "-1"));
	DbWrapper::addTeam(new Team("7", "Chili", "B", "-1"));
	DbWrapper::addTeam(new Team("8", "Australie", "B", "-1"));

	DbWrapper::addTeam(new Team("9", "Colombie", "C", "-1"));
	DbWrapper::addTeam(new Team("10", "Grèce", "C", "-1"));
	DbWrapper::addTeam(new Team("11", "Côte d'ivoire", "C", "-1"));
	DbWrapper::addTeam(new Team("12", "Japon", "C", "-1"));

	DbWrapper::addTeam(new Team("13", "Uruguay", "D", "-1"));
	DbWrapper::addTeam(new Team("14", "Costa Rica", "D", "-1"));
	DbWrapper::addTeam(new Team("15", "Angleterre", "D", "-1"));
	DbWrapper::addTeam(new Team("16", "Italie", "D", "-1"));

	DbWrapper::addTeam(new Team("17", "Suisse", "E", "-1"));
	DbWrapper::addTeam(new Team("18", "Equateur", "E", "-1"));
	DbWrapper::addTeam(new Team("19", "France", "E", "-1"));
	DbWrapper::addTeam(new Team("20", "Honduras", "E", "-1"));

	DbWrapper::addTeam(new Team("21", "Argentine", "F", "-1"));
	DbWrapper::addTeam(new Team("22", "Bosnie", "F", "-1"));
	DbWrapper::addTeam(new Team("23", "Iran", "F", "-1"));
	DbWrapper::addTeam(new Team("24", "Nigeria", "F", "-1"));

	DbWrapper::addTeam(new Team("25", "Allemagne", "G", "-1"));
	DbWrapper::addTeam(new Team("26", "Portugal", "G", "-1"));
	DbWrapper::addTeam(new Team("27", "Ghana", "G", "-1"));
	DbWrapper::addTeam(new Team("28", "Etats-Unis", "G", "-1"));

	DbWrapper::addTeam(new Team("29", "Belgique", "H", "-1"));
	DbWrapper::addTeam(new Team("30", "Algérie", "H", "-1"));
	DbWrapper::addTeam(new Team("31", "Russie", "H", "-1"));
	DbWrapper::addTeam(new Team("32", "Corée du Sud", "H", "-1"));
	print("Teams: OK<br>");
}

function setUpMatches() {
	DbWrapper::addGame(new Game("1", "A", "2014-06-12 22:00:00", "1", "2", "-1", "-1"));
	DbWrapper::addGame(new Game("2", "A", "2014-06-13 18:00:00", "3", "4", "-1", "-1"));
	DbWrapper::addGame(new Game("3", "A", "2014-06-17 21:00:00", "1", "3", "-1", "-1"));
	DbWrapper::addGame(new Game("4", "A", "2014-06-18 00:00:00", "4", "2", "-1", "-1"));
	DbWrapper::addGame(new Game("5", "A", "2014-06-23 22:00:00", "2", "3", "-1", "-1"));
	DbWrapper::addGame(new Game("6", "A", "2014-06-23 22:00:00", "4", "1", "-1", "-1"));
	
	DbWrapper::addGame(new Game("7", "B", "2014-06-13 21:00:00", "5", "6", "-1", "-1"));
	DbWrapper::addGame(new Game("8", "B", "2014-06-14 00:00:00", "7", "8", "-1", "-1"));
	DbWrapper::addGame(new Game("9", "B", "2014-06-18 18:00:00", "8", "6", "-1", "-1"));
	DbWrapper::addGame(new Game("10", "B", "2014-06-18 21:00:00", "5", "7", "-1", "-1"));
	DbWrapper::addGame(new Game("11", "B", "2014-06-23 18:00:00", "8", "5", "-1", "-1"));
	DbWrapper::addGame(new Game("12", "B", "2014-06-23 18:00:00", "6", "7", "-1", "-1"));
	
	DbWrapper::addGame(new Game("13", "C", "2014-06-14 18:00:00", "9", "10", "-1", "-1"));
	DbWrapper::addGame(new Game("14", "C", "2014-06-15 03:00:00", "11", "12", "-1", "-1"));
	DbWrapper::addGame(new Game("15", "C", "2014-06-19 18:00:00", "9", "11", "-1", "-1"));
	DbWrapper::addGame(new Game("16", "C", "2014-06-20 00:00:00", "12", "10", "-1", "-1"));
	DbWrapper::addGame(new Game("17", "C", "2014-06-24 22:00:00", "12", "9", "-1", "-1"));
	DbWrapper::addGame(new Game("18", "C", "2014-06-24 22:00:00", "10", "11", "-1", "-1"));
	
	DbWrapper::addGame(new Game("19", "D", "2014-06-14 21:00:00", "13", "14", "-1", "-1"));
	DbWrapper::addGame(new Game("20", "D", "2014-06-15 00:00:00", "15", "16", "-1", "-1"));
	DbWrapper::addGame(new Game("21", "D", "2014-06-19 21:00:00", "13", "15", "-1", "-1"));
	DbWrapper::addGame(new Game("22", "D", "2014-06-20 18:00:00", "16", "14", "-1", "-1"));
	DbWrapper::addGame(new Game("23", "D", "2014-06-24 18:00:00", "16", "13", "-1", "-1"));
	DbWrapper::addGame(new Game("24", "D", "2014-06-24 18:00:00", "14", "15", "-1", "-1"));
	
	DbWrapper::addGame(new Game("25", "E", "2014-06-15 18:00:00", "17", "18", "-1", "-1"));
	DbWrapper::addGame(new Game("26", "E", "2014-06-15 21:00:00", "19", "20", "-1", "-1"));
	DbWrapper::addGame(new Game("27", "E", "2014-06-20 21:00:00", "17", "19", "-1", "-1"));
	DbWrapper::addGame(new Game("28", "E", "2014-06-21 00:00:00", "20", "18", "-1", "-1"));
	DbWrapper::addGame(new Game("29", "E", "2014-06-25 22:00:00", "18", "19", "-1", "-1"));
	DbWrapper::addGame(new Game("30", "E", "2014-06-25 22:00:00", "20", "17", "-1", "-1"));
	
	DbWrapper::addGame(new Game("31", "F", "2014-06-16 00:00:00", "21", "22", "-1", "-1"));
	DbWrapper::addGame(new Game("32", "F", "2014-06-16 21:00:00", "23", "24", "-1", "-1"));
	DbWrapper::addGame(new Game("33", "F", "2014-06-21 18:00:00", "21", "23", "-1", "-1"));
	DbWrapper::addGame(new Game("34", "F", "2014-06-22 00:00:00", "24", "22", "-1", "-1"));
	DbWrapper::addGame(new Game("35", "F", "2014-06-25 18:00:00", "22", "23", "-1", "-1"));
	DbWrapper::addGame(new Game("36", "F", "2014-06-25 18:00:00", "24", "21", "-1", "-1"));
	
	DbWrapper::addGame(new Game("37", "G", "2014-06-16 18:00:00", "25", "26", "-1", "-1"));
	DbWrapper::addGame(new Game("38", "G", "2014-06-17 00:00:00", "27", "28", "-1", "-1"));
	DbWrapper::addGame(new Game("39", "G", "2014-06-21 21:00:00", "25", "27", "-1", "-1"));
	DbWrapper::addGame(new Game("40", "G", "2014-06-22 00:00:00", "28", "26", "-1", "-1"));
	DbWrapper::addGame(new Game("41", "G", "2014-06-26 18:00:00", "26", "27", "-1", "-1"));
	DbWrapper::addGame(new Game("42", "G", "2014-06-26 18:00:00", "28", "25", "-1", "-1"));
	
	DbWrapper::addGame(new Game("43", "H", "2014-06-17 18:00:00", "29", "30", "-1", "-1"));
	DbWrapper::addGame(new Game("44", "H", "2014-06-18 00:00:00", "31", "32", "-1", "-1"));
	DbWrapper::addGame(new Game("45", "H", "2014-06-22 18:00:00", "29", "31", "-1", "-1"));
	DbWrapper::addGame(new Game("46", "H", "2014-06-22 21:30:00", "32", "30", "-1", "-1"));
	DbWrapper::addGame(new Game("47", "H", "2014-06-26 22:00:00", "30", "31", "-1", "-1"));
	DbWrapper::addGame(new Game("48", "H", "2014-06-26 22:00:00", "32", "29", "-1", "-1"));
	
	DbWrapper::addGame(new Game("49", "8Fin", "2014-06-28 18:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("50", "8Fin", "2014-06-28 22:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("51", "8Fin", "2014-06-29 18:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("52", "8Fin", "2014-06-29 22:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("53", "8Fin", "2014-06-30 18:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("54", "8Fin", "2014-06-30 22:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("55", "8Fin", "2014-07-01 18:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("56", "8Fin", "2014-07-01 22:00:00", "0", "0", "-1", "-1"));
	
	DbWrapper::addGame(new Game("57", "4Fin", "2014-07-04 18:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("58", "4Fin", "2014-07-04 22:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("59", "4Fin", "2014-07-05 18:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("60", "4Fin", "2014-07-05 22:00:00", "0", "0", "-1", "-1"));
	
	DbWrapper::addGame(new Game("61", "2Fin", "2014-07-08 22:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("62", "2Fin", "2014-07-09 22:00:00", "0", "0", "-1", "-1"));
	
	DbWrapper::addGame(new Game("63", "3Fin", "2014-07-12 22:00:00", "0", "0", "-1", "-1"));
	
	DbWrapper::addGame(new Game("64", "1Fin", "2014-07-13 21:00:00", "0", "0", "-1", "-1"));
	
	print("Matches: OK<br>");
}

setUpTeams();
setUpMatches();
print("OK.");
?>