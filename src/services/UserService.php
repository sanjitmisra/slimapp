<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../models/User.php';

class UserService
{
	private $conn;
	private $tablename = "users";

	public function __construct($db)
	{
		$this->conn = $db;
	}
	

	public function get($username, $password)
	{
		$query = "SELECT passwordhash FROM users WHERE username = '" . $username . "'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();  
		return $stmt;
	}
}