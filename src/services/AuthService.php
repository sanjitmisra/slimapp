
<?php

include_once '../models/Auth.php';
include_once '../database/db.php';


class AuthService
{
	private $conn;
	private $tablename = "auth";

	public function __construct()
	{}

	public function createPasswordHash($password)
	{
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
		return $hashedPassword;
	}

	public function saveAuthDetails($userId, $hashedPassword)
	{
		// Create a DB Object
		$database = new Database();
		$db = $database->getConnection();
						
		$auth = new Auth($db);
		$auth->userId = $userId;
		$auth->passwordHash = $hashedPassword;
		return $auth->create();
	}

	public function validateCredentials($userId, $password)
	{
		// Create a DB Object
		$database = new Database();
		$db = $database->getConnection();

		$userAuth = new Auth($db);
		$userAuth->userId = $userId;
		$userAuthDetails = $userAuth->getspecific();

		if($userAuthDetails != false)
		{
			// Perform the verification here
			if(password_verify($password, $userAuthDetails))
			{
				return true;
			}
		}
		return false;
	}
}