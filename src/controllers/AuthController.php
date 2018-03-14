<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once '../services/UserService.php';
include_once '../services/AuthService.php';
include_once '../database/db.php';


class AuthController
{
	public function __construct()
	{}

	public function authenticate($request, $response, $args)
	{
		$parsedBody = $request->getParsedBody();
		$username = $parsedBody['username'] ?? false;
		$password = $parsedBody['password'] ?? false;

		// This needs to be fixed, get actual userId by resolving the username. Call UserService here.
		$userSvc = new UserService();
		$userid = $userSvc->getUserIdForUserName($username);
		
		// Create an instance of UserService
		$authSvc = new AuthService();
		$result = $authSvc->validateCredentials($userid, $password);
		
		if($result == true)
		{
			//User authenticated
			$token = uniqid('', true);
			$responseData = array('bearer' => $token);
			return $response->withJson($responseData, 200);
		}
		else
		{
			// Auth failed
			$responseData = array('message' => 'Could not authenticate user. Check the password.');
			return $response->withJson($responseData, 401);
		}
	}

	public function createUserCredentials($request, $response, $args)
	{

		// Fetch the password string from the request object
		$parsedBody = $request->getParsedBody();
		$userId = $parsedBody['userid'] ?? false;
		$password = $parsedBody['password'] ?? false;

		$authSvc = new AuthService();
		$hashedPassword = $authSvc->createPasswordHash($password);

		// Save the auth details in the auth table
		$isAuthCreatedsuccessfully = $authSvc->saveAuthDetails($userId, $hashedPassword);

		if($isAuthCreatedsuccessfully == true)
		{
			$responseData = array('message' => 'Auth details for the user have been created.');
			return $response->withJson($responseData, 200);
		}
		else
		{
			$responseData = array('message' => 'Failed to create Auth details for the user.');
			return $response->withJson($responseData, 400);
		}
	}
}
	