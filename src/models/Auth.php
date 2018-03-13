<?php

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

	public function create($auth)
	{
		$query = "INSERT INTO " . $this->table_name . "SET userid=:userId, passwordhash=:passwordHash, passwordSalt=:passwordSalt";

		$stmt = $this->conn->prepare($query);

		// Parameter Binding
		$stmt->bindParam(":userid", $this->userId); 
		$stmt->bindParam(":passwordhash", $this->passwordHash);
		$stmt->bindParam(":passwordSalt", $this->passwordSalt);

		if($stmt->execute())
		{
			return true;
		}

		return flase;
	}
}