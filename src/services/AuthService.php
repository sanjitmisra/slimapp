
<?php

class AuthService
{
	private $conn;
	private $tablename = "auth";

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function createPasswordHash($password, $salt)
	{
		$options = [
				'cost' = 10,
				'salt' = $salt;
			];

		$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
		return $hashedPassword;
	}

	public function saveAuthDetails($userId, $hashedPassword, $salt)
	{
			$auth = new Auth();
			$auth->userId = $userId;
			$auth->passwordSalt = $salt;
			$auth->hashedPassword = $hashedPassword;

			if($auth->create())
			{
				return true;
			}
			return false;
	}
}