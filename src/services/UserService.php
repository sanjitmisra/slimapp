<?php

include_once '../models/User.php';
include_once '../database/db.php';

class UserService
{
	private $conn;
	private $tablename = "users";

	public function __construct()
	{
		//$this->conn = $db;
	}

	public function getAll($username, $password)
	{
		$query = "SELECT passwordhash FROM users WHERE username = '" . $username . "'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();  
		return $stmt;
	}

	public function getUserIdForUserName($username)
	{
		// Create a DB Object
		$database = new Database();
		$db = $database->getConnection();
		
		$user = new User($db);
		$allUsers = $user->get();

		foreach($allUsers["records"] as $user)
		{
			if($user["username"] == $username)
			{
				// User found
				return $user['id'];
			}
		}
		// User does not exist
		return false;
	}
}