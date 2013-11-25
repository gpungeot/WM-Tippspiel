<?php
class User {
	private $userid;
	private $nick;
	private $name;
	private $surname;
	private $password;
	private $email;
	private $cupwinner;
	private $accepted;
	

	public function getUserId() {
		return $this->userid;
	}

	public function getName() {
		return $this->name;
	}

	public function getSurname() {
		return $this->surname;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getMailAddress() {
		return $this->email;
	}
	
	public function getCupWinner() {
		return $this->cupwinner;
	}

	public function isAccepted() {
		return $this->accepted>0;
	}
	
	public function __construct($userid, $name, $surname, $password, $email, $cupwinner=0,$accepted = 1) {
		$this->userid = $userid;		
		$this->name = $name;
		$this->surname = $surname;
		$this->password = $password;
		$this->email = $email;
		$this->cupwinner = $cupwinner;
		$this->accepted = $accepted;
	}
}
?>