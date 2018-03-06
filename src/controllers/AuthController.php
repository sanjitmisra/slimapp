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

		$data = $userSvc->get($username, $password);
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
}
