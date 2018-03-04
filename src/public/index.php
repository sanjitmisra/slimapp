<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require_once('controllers/GreetingController.php');
require_once('controllers/AuthController.php');
require_once('controllers/IncidentController.php');
require_once('controllers/UserController.php');

//Configs needed in the app
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;


//Instantiate the app
$app = new \Slim\App(['settings' => $config]);

//Get the container
$container = $app->getContainer();

//Add the logging container
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};	

// Register the Greetings controller
$container['GreetingController'] = function($c){
	return new GreetingController();
};

//Register Routes
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    
    $name = $args['name'];
    $this->logger->addInfo("Request recieved in GET /hello/{name}");

    $data = array('name' => $name, 'message' => 'Welcome');
    return $response->withJson($data,200);
});


$app->get('/greetings/{name}', \GreetingController::class . ':hello');
	
//Launch app
$app->run();