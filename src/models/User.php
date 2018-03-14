<?php

class User
{
	public $id;
	public $username;
	public $passwordhash;
	public $created;

	// DB Info
	private $conn;
	private $table_name = "users";

	// Constructor
	public function __construct($db)
	{
		$this->conn = $db;
	}

	// Get all user records
	public function get()
	{
		$query = "SELECT id, username, created, modified FROM " . $this->table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$num = $stmt->rowCount();

		if($num > 0)
		{
			$resultSet = array();
			$resultSet["records"] = array();

			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				extract($row);
				$item = array("id" => $id, "username" => $username, "created" => $created, "modified" => $modified);
				array_push($resultSet["records"], $item);
			}
			return $resultSet;
		}
		else
		{
			return false;
		}
	}
}