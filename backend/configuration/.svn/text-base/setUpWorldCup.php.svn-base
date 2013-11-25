<?php
include_once('../../common.php');
print(DbWrapper::connectToDatabase());

function setUpTeams() {
	DbWrapper::addTeam(new Team("0", "#", "0", "0"));
	DbWrapper::addTeam(new Team("1", "Südafrika", "A", "1"));
	DbWrapper::addTeam(new Team("2", "Mexiko", "A", "1"));
	DbWrapper::addTeam(new Team("3", "Uruguay", "A", "1"));
	DbWrapper::addTeam(new Team("4", "Frankreich", "A", "1"));

	DbWrapper::addTeam(new Team("5", "Argentinien", "B", "1"));
	DbWrapper::addTeam(new Team("6", "Nigeria", "B", "1"));
	DbWrapper::addTeam(new Team("7", "Südkorea", "B", "1"));
	DbWrapper::addTeam(new Team("8", "Griechenland", "B", "1"));

	DbWrapper::addTeam(new Team("9", "England", "C", "1"));
	DbWrapper::addTeam(new Team("10", "USA", "C", "1"));
	DbWrapper::addTeam(new Team("11", "Algerien", "C", "1"));
	DbWrapper::addTeam(new Team("12", "Slowenien", "C", "1"));

	DbWrapper::addTeam(new Team("13", "Deutschland", "D", "1"));
	DbWrapper::addTeam(new Team("14", "Australien", "D", "1"));
	DbWrapper::addTeam(new Team("15", "Serbien", "D", "1"));
	DbWrapper::addTeam(new Team("16", "Ghana", "D", "1"));

	DbWrapper::addTeam(new Team("17", "Niederlande", "E", "1"));
	DbWrapper::addTeam(new Team("18", "Dänemark", "E", "1"));
	DbWrapper::addTeam(new Team("19", "Japan", "E", "1"));
	DbWrapper::addTeam(new Team("20", "Kamerun", "E", "1"));

	DbWrapper::addTeam(new Team("21", "Italien", "F", "1"));
	DbWrapper::addTeam(new Team("22", "Paraguay", "F", "1"));
	DbWrapper::addTeam(new Team("23", "Neuseeland", "F", "1"));
	DbWrapper::addTeam(new Team("24", "Slowakei", "F", "1"));

	DbWrapper::addTeam(new Team("25", "Brasilien", "G", "1"));
	DbWrapper::addTeam(new Team("26", "Nordkorea", "G", "1"));
	DbWrapper::addTeam(new Team("27", "Elfenbeinküste", "G", "1"));
	DbWrapper::addTeam(new Team("28", "Portugal", "G", "1"));

	DbWrapper::addTeam(new Team("29", "Spanien", "H", "1"));
	DbWrapper::addTeam(new Team("30", "Schweiz", "H", "1"));
	DbWrapper::addTeam(new Team("31", "Honduras", "H", "1"));
	print("Teams: ".DbWrapper::addTeam(new Team("32", "Chile", "H", "1"))."<br>");
}

function setUpMatches() {
	DbWrapper::addGame(new Game("1", "A", "2010-06-11 16:00:00", "1", "2", "-1", "-1"));
	DbWrapper::addGame(new Game("2", "A", "2010-06-11 20:30:00", "3", "4", "-1", "-1"));
	DbWrapper::addGame(new Game("3", "A", "2010-06-16 20:30:00", "1", "3", "-1", "-1"));
	DbWrapper::addGame(new Game("4", "A", "2010-06-17 20:30:00", "4", "2", "-1", "-1"));
	DbWrapper::addGame(new Game("5", "A", "2010-06-22 16:00:00", "2", "3", "-1", "-1"));
	DbWrapper::addGame(new Game("6", "A", "2010-06-22 16:00:00", "4", "1", "-1", "-1"));
	
	DbWrapper::addGame(new Game("7", "B", "2010-06-12 13:30:00", "7", "8", "-1", "-1"));
	DbWrapper::addGame(new Game("8", "B", "2010-06-12 16:00:00", "5", "6", "-1", "-1"));
	DbWrapper::addGame(new Game("9", "B", "2010-06-17 13:30:00", "5", "7", "-1", "-1"));
	DbWrapper::addGame(new Game("10", "B", "2010-06-17 16:00:00", "8", "6", "-1", "-1"));
	DbWrapper::addGame(new Game("11", "B", "2010-06-22 20:30:00", "6", "7", "-1", "-1"));
	DbWrapper::addGame(new Game("12", "B", "2010-06-22 20:30:00", "8", "5", "-1", "-1"));
	
	DbWrapper::addGame(new Game("13", "C", "2010-06-12 20:30:00", "9", "10", "-1", "-1"));
	DbWrapper::addGame(new Game("14", "C", "2010-06-13 13:30:00", "11", "12", "-1", "-1"));
	DbWrapper::addGame(new Game("15", "C", "2010-06-18 16:00:00", "12", "10", "-1", "-1"));
	DbWrapper::addGame(new Game("16", "C", "2010-06-18 20:30:00", "9", "11", "-1", "-1"));
	DbWrapper::addGame(new Game("17", "C", "2010-06-23 16:00:00", "10", "11", "-1", "-1"));
	DbWrapper::addGame(new Game("18", "C", "2010-06-23 16:00:00", "12", "9", "-1", "-1"));
	
	DbWrapper::addGame(new Game("19", "D", "2010-06-13 16:00:00", "15", "16", "-1", "-1"));
	DbWrapper::addGame(new Game("20", "D", "2010-06-13 20:30:00", "13", "14", "-1", "-1"));
	DbWrapper::addGame(new Game("21", "D", "2010-06-18 13:30:00", "13", "15", "-1", "-1"));
	DbWrapper::addGame(new Game("22", "D", "2010-06-19 16:00:00", "16", "14", "-1", "-1"));
	DbWrapper::addGame(new Game("23", "D", "2010-06-23 20:30:00", "14", "15", "-1", "-1"));
	DbWrapper::addGame(new Game("24", "D", "2010-06-23 20:30:00", "16", "13", "-1", "-1"));
	
	DbWrapper::addGame(new Game("25", "E", "2010-06-14 13:30:00", "17", "18", "-1", "-1"));
	DbWrapper::addGame(new Game("26", "E", "2010-06-14 16:00:00", "19", "20", "-1", "-1"));
	DbWrapper::addGame(new Game("27", "E", "2010-06-19 13:30:00", "17", "19", "-1", "-1"));
	DbWrapper::addGame(new Game("28", "E", "2010-06-19 20:30:00", "20", "18", "-1", "-1"));
	DbWrapper::addGame(new Game("29", "E", "2010-06-24 20:30:00", "18", "19", "-1", "-1"));
	DbWrapper::addGame(new Game("30", "E", "2010-06-24 20:30:00", "20", "17", "-1", "-1"));
	
	DbWrapper::addGame(new Game("31", "F", "2010-06-14 20:30:00", "21", "22", "-1", "-1"));
	DbWrapper::addGame(new Game("32", "F", "2010-06-15 13:30:00", "23", "24", "-1", "-1"));
	DbWrapper::addGame(new Game("33", "F", "2010-06-20 13:30:00", "24", "22", "-1", "-1"));
	DbWrapper::addGame(new Game("34", "F", "2010-06-20 16:00:00", "21", "23", "-1", "-1"));
	DbWrapper::addGame(new Game("35", "F", "2010-06-24 16:00:00", "22", "23", "-1", "-1"));
	DbWrapper::addGame(new Game("36", "F", "2010-06-24 16:00:00", "24", "21", "-1", "-1"));
	
	DbWrapper::addGame(new Game("37", "G", "2010-06-15 16:00:00", "27", "28", "-1", "-1"));
	DbWrapper::addGame(new Game("38", "G", "2010-06-15 20:30:00", "25", "26", "-1", "-1"));
	DbWrapper::addGame(new Game("39", "G", "2010-06-20 20:30:00", "25", "27", "-1", "-1"));
	DbWrapper::addGame(new Game("40", "G", "2010-06-21 13:30:00", "28", "26", "-1", "-1"));
	DbWrapper::addGame(new Game("41", "G", "2010-06-25 16:00:00", "26", "27", "-1", "-1"));
	DbWrapper::addGame(new Game("42", "G", "2010-06-25 16:00:00", "28", "25", "-1", "-1"));
	
	DbWrapper::addGame(new Game("43", "H", "2010-06-16 13:30:00", "31", "32", "-1", "-1"));
	DbWrapper::addGame(new Game("44", "H", "2010-06-16 16:00:00", "29", "30", "-1", "-1"));
	DbWrapper::addGame(new Game("45", "H", "2010-06-21 16:00:00", "32", "30", "-1", "-1"));
	DbWrapper::addGame(new Game("46", "H", "2010-06-21 20:30:00", "29", "31", "-1", "-1"));
	DbWrapper::addGame(new Game("47", "H", "2010-06-25 20:30:00", "30", "31", "-1", "-1"));
	DbWrapper::addGame(new Game("48", "H", "2010-06-25 20:30:00", "32", "29", "-1", "-1"));
	
	DbWrapper::addGame(new Game("49", "8Fin", "2010-06-26 16:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("50", "8Fin", "2010-06-26 20:30:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("51", "8Fin", "2010-06-27 16:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("52", "8Fin", "2010-06-27 20:30:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("53", "8Fin", "2010-06-28 16:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("54", "8Fin", "2010-06-28 20:30:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("55", "8Fin", "2010-06-29 16:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("56", "8Fin", "2010-06-29 20:30:00", "0", "0", "-1", "-1"));
	
	DbWrapper::addGame(new Game("57", "4Fin", "2010-07-02 16:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("58", "4Fin", "2010-07-02 20:30:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("59", "4Fin", "2010-07-03 16:00:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("60", "4Fin", "2010-07-03 20:30:00", "0", "0", "-1", "-1"));
	
	DbWrapper::addGame(new Game("61", "2Fin", "2010-07-06 20:30:00", "0", "0", "-1", "-1"));
	DbWrapper::addGame(new Game("62", "2Fin", "2010-07-07 20:30:00", "0", "0", "-1", "-1"));
	
	DbWrapper::addGame(new Game("63", "3Fin", "2010-07-10 20:30:00", "0", "0", "-1", "-1"));
	
	print("Matches: ".DbWrapper::addGame(new Game("64", "1Fin", "2010-07-11 20:30:00", "0", "0", "-1", "-1"))."<br>");
}

setUpTeams();
setUpMatches();
print("Weltmeisterschaftsdaten wurden eingefügt.");
?>