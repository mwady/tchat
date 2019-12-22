<?php

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('signin', ['controller' => 'Login', 'action' => 'auth']);
$router->add('logout', ['controller' => 'Login', 'action' => 'logout']);

$router->add('register', ['controller' => 'Register', 'action' => 'register']);
$router->add('signup', ['controller' => 'Register', 'action' => 'signup']);

$router->add('messages', ['controller' => 'Dashboard', 'action' => 'dashboard']);
$router->add('live_users', ['controller' => 'Dashboard', 'action' => 'liveUsers']);
$router->add('conversation', ['controller' => 'Dashboard', 'action' => 'conversation']);
$router->add('add_message', ['controller' => 'Dashboard', 'action' => 'addMessage']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
