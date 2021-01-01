<?php
namespace app\core;

require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\Auth;
use app\core\Application;

define('ROOT', dirname(__DIR__));


$app = new Application(ROOT);

// page not found
$app->router->get('404', function(){
	return 'route not found';
});

// $app->router->get('/users', function(){
// 	return 'Hello World';
// });

// $app->router->get('/index', 'view');

// $app->router->get('/home', [Controller::class, 'home']);

$app->router->get('/auth/create', [Auth::class, 'create']);
$app->router->post('/auth/create', [Auth::class, 'create']);




$app->run();