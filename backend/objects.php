<?php
class Team {
	private $teamid;
	private $name;
	private $group;
	private $position;


	public function getTeamId() {
		return $this->teamid;
	}

	public function getName() {
		return $this->name;
	}

	public function getGroup() {
		return $this->group;
	}

	public function getPosition() {
		return $this->position;
	}

	public function setPosition($pos) {
		$this->position = $pos;
	}

	public function __construct($teamid, $name, $group, $position) {
		$this->teamid = $teamid;
		$this->name = $name;
		$this->group = $group;
		$this->position = $position;
	}
}

class Score {
	private $goals1;
	private $goals2;

	public function getFirstTeamGoals() {
		return $this->goals1;
	}

	public function getSecondTeamGoals() {
		return $this->goals2;
	}

	public function isNotEmpty()
	{
		return ($this->goals1>=0)&&($this->goals2>=0);
	}
	
	public function __construct($goals1, $goals2) {
		$this->goals1 = $goals1;
		$this->goals2 = $goals2;		
	}
}

class Game {
	private $gameid;
	private $type;
	private $time;
	private $team1;
	private $team2;
	
	private $score;

	private $endScore;
	
	public function getGameId() {
		return $this->gameid;
	}

	public function getType() {
		return $this->type;
	}

	public function getTime() {
		return $this->time;
	}

	public function getFirstTeam() {
		return $this->team1;
	}

	public function getSecondTeam() {
		return $this->team2;
	}

	public function getScore() {
		return $this->score;
	}

	public function setScore($goals1, $goals2) {
		$this->score = new Score($goals1, $goals2);
	}
	
	private function setEndScore($goals1, $goals2) {
		print(" Moin");
		$this->endScore = new Score($goals1, $goals2);
	}
	
	public function getEndScore() {
		return $this->endScore;
	}

	public function getFirstTeamGoals()
	{
		return $this->score->getFirstTeamGoals();
	}
	
	public function getFirstTeamEndGoals()
	{
		return $this->endScore->getFirstTeamGoals();
	}
	
	public function getSecondTeamGoals()
	{
		return $this->score->getSecondTeamGoals();
	}
	
	public function getSecondTeamEndGoals()
	{
		return $this->endScore->getSecondTeamGoals();
	}
	
	public function hasDifferentEndScore()
	{
		if($this->endScore==null)
			return false;
		else 
			return true;
	}
	
	public function isCompleted()
	{
		return $this->score->isNotEmpty();
	}
	
	public function __construct($gameid, $type, $time, $team1, $team2, $goals1, $goals2,$endGoals1 = -1,$endGoals2 = -1) {
		$this->gameid = $gameid;
		$this->type = $type;
		$this->time = $time;
		$this->team1 = $team1;
		$this->team2 = $team2;		
		
		$this->score = new Score($goals1, $goals2);
		if(($endGoals1!="") && ($endGoals1>=0))
		{
			$this->endScore = new Score($endGoals1, $endGoals2);
		}
		else
		{			
			$this->endScore=null;
		}
	}
}

class MatchBet {
	private $userid;
	private $game;
	private $bet;

	public function getUserId() {
		return $this->userid;
	}

	public function getGameId() {
		return $this->game->getGameId();
	}

	public function getType() {
		return $this->game->getType();
	}

	public function getTime() {
		return $this->game->getTime();
	}

	public function getFirstTeam() {
		return $this->game->getFirstTeam();
	}

	public function getSecondTeam() {
		return $this->game->getSecondTeam();
	}

	public function getResult() {
		return $this->game->getScore();
	}
	
	public function getEndResult() {
		return $this->game->getEndScore();
	}

	public function getBet() {
		return $this->bet;
	}

	public function hasDifferentEndScore()
	{
		return $this->game->hasDifferentEndScore();
	}
	
	public function __construct($userid, $game, $bet) {
		if(!($game instanceof Game))
		die("Unknown constructor: MatchBet needs a Game to initialize.");
		if(!($bet instanceof Score) && $bet!=null)
		die("Unknown constructor: MatchBet needs a Score to initialize.");
		$this->game = $game;
		$this->userid = $userid;
		$this->bet = $bet;
	}
}

class TeamBet {
	private $userid;
	private $team;
	private $bet;

		
	public function getUserId() {
		return $this->userid;
	}

	public function getTeamId() {
		return $this->team->getTeamId();
	}

	public function getGroup() {
		return $this->team->getGroup();
	}

	public function getTeamName() {
		return $this->team->getName();
	}

	public function getRealPosition() {
		return $this->team->getPosition();
	}

	public function getBetPosition() {
		return $this->bet;
	}

	public function __construct($userid, $team, $bet) {
		if(!($team instanceof Team))
		die("Unknown constructor: TeamBet needs a Team to initialize.");
		$this->team = $team;
		$this->userid = $userid;
		$this->bet = $bet;
	}
}

?>