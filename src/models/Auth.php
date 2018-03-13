<?php

include_once '../database/db.php';

class Auth
{
	// Object Props
	public $userId;
	public $passwordSalt;
	public $passwordHash;

	// DB Info
	private $conn;
	private $table_name = "auth";

	// Constructor
	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function create()
	{
		$query = "INSERT INTO " . $this->table_name . " (userid, passwordhash, passwordsalt) VALUES (" . $this->userId . ",'" . $this->passwordHash . "','" . $this->passwordSalt . "')";

		$stmt = $this->conn->prepare($query);

		// Parameter Binding
		/*$stmt->bindParam(":userid", $this->userId); 
		$stmt->bindParam(":passwordhash", $this->passwordHash);
		$stmt->bindParam(":passwordSalt", $this->passwordSalt);*/
		$stmt->execute();
		
		return "INSERT INTO " . $this->table_name . " (userid, passwordhash, passwordsalt) VALUES (" . $this->userId . ",'" . $this->passwordHash . "','" ;
		//. $this->userId . "','" . $this->passwordHash . "','" . $this->passwordSalt . "')";
	}
}