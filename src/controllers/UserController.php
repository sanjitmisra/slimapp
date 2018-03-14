<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once '../services/UserService.php';
include_once '../services/AuthService.php';

class UserController
{
	public function __construct()
	{}

	
}

/* Password hash creation logic
$options = array(
    					'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    					'cost' => 12,
  						);
  		$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
*/