<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


/* Password hash creation logic
$options = array(
    					'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    					'cost' => 12,
  						);
  		$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
*/