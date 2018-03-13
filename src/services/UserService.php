<?php

include_once '../models/User.php';

class UserService
{
	private $conn;
	private $tablename = "users";

	public function __construct($db)
	{
		$this->conn = $db;
	}
	

	public function getAll($username, $password)
	{
		$query = "SELECT passwordhash FROM users WHERE username = '" . $username . "'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();  
		return $stmt;
	}
}