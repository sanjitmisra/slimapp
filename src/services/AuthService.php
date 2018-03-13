
<?php

include_once '../models/Auth.php';
include_once '../database/db.php';


class AuthService
{
	private $conn;
	private $tablename = "auth";

	public function __construct()
	{}

	public function createPasswordHash($password, $salt)
	{
		$options = array(
				'cost' => 10,
				'salt' => $salt,
			);

		$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
		return $hashedPassword;
	}

	public function saveAuthDetails($userId, $hashedPassword, $salt)
	{
			// Create a DB Object
			$database = new Database();
			$db = $database->getConnection();
			
			$auth = new Auth($db);
			$auth->userId = $userId;
			$auth->passwordSalt = $salt;
			$auth->passwordHash = $hashedPassword;

			return $auth->create();
	}
}