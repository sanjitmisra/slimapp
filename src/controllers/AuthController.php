<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once '../services/UserService.php';
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

		// Get the password hash from the DB here
		$passwordHash = "";

		
		// Create a DB Object
		$database = new Database();
		$db = $database->getConnection();

		// Create an instance of UserService
		$userSvc = new UserService($db);

		$data = $userSvc->getAll($username, $password);
		$num = $data->rowCount();
		
		//if(password_verify($password, $passwordHash))
		if($num > 0)
		{
			//User authenticated
			//$retData = $userSvc->get($username, $password);
			$responseData = array('bearer' => 'shdkw84eoqjdnlkue23elksand');
			return $response->withJson($responseData, 200);
		}
		else
		{
			return $response->withJson($num,401);
		}
	}

	public function createUserCredentials($request, $response, $args)
	{

		// Fetch the password string from the request object
		$parsedBody = $request->getParsedBody();
		$userId = $parsedBody['userid'] ?? false;
		$password = $parsedBody['password'] ?? false;

		$authSvc = new AuthService($db);
		$randomizedSalt = random_bytes(20);
		$hashedPassword = $authSvc->createPasswordHash($password, $randomizedSalt);

		// Save the auth details in the auth table
		$isAuthCreatedsuccessfully = $authSvc->saveAuthDetails($userId, $hashedPassword, $randomizedSalt);

		if($isAuthCreatedsuccessfully == true)
		{
			$responseData = array('message' => 'Auth details for the user have been created.')
			return $reponse->withJson($responseData, 200);
		}
		else
		{
			$responseData = array('message' => 'Failed to create Auth details for the user.')
			return $reponse->withJson($responseData, 400);
		}
	}
}
	