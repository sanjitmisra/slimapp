<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AuthController
{
	public function __construct()
	{}

	public function authenticate($request, $response, $args)
	{
		$parsedBody = $request->getParsedBody();
		$username = $parsedBody['username'] ?? false;
		$password = $parsedBody['password'] ?? false;

		// Get the password hash from the DB here
		$passwordHash = "";
		
		if(password_verify($password, $passwordHash))
		{
			//User authenticated
		}
		else
		{
			//Send 401
		}
		
	}
}
