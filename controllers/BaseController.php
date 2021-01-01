<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;

class BaseController extends Controller
{
    public function contact(Request $request, Response $response)
    {
    	$params = [
    		'name' => 'daniel'
    	];
    	return $response->render('home', $params);
    }

    public function home(Request $request, Response $response)
    {
    	$response->setLayout('auth');
    	return $response->render('home');
    }
}