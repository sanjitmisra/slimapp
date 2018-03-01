<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

class GreetingController
{
	public function __construct()
	{}

	public function hello($request, $response, $args)
	{
		$name = $args['name'];
		$data = array('name' => $name, 'message' => 'Hello!!');
    	return $response->withJson($data,200);
	}
}
