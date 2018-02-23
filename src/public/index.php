<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

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

//Register Routes
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    
    $name = $args['name'];
    $this->logger->addInfo("Request recieved in GET /hello/{name}");

    $data = array('name' => $name, 'message' => 'Welcome');
    return $response->withJson($data,200);
});


//Launch app
$app->run();