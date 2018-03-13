<?php

include_once '../database/db.php';

class Auth
{
	// Object Props
	public $userId;
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
		$query = "INSERT INTO " . $this->table_name . " (userid, passwordhash) VALUES (" . $this->userId . ",'" . $this->passwordHash . "')";
		$stmt = $this->conn->prepare($query);
		if($stmt->execute())
		{
			return true;
		}
		return false;
		//return "INSERT INTO " . $this->table_name . " (userid, passwordhash) VALUES (" . $this->userId . ",'" . $this->passwordHash . "')";
	}

	// To use this function, the $userId property needs to be set by the caller method prior to calling.
	public function getspecific()
	{
		$query = "SELECT passwordhash FROM " . $this->table_name . " WHERE userid = " . $this->userId;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		$num = $stmt->rowCount();

		if($num > 0)
		{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				extract($row);
				return $passwordhash;
			}
		}
		else
		{
			return false;
		}
	}
}