<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;
use app\core\Validation;

class Auth extends Controller
{
    public function create($req, $res)
    {
		if($req->isPost()){
			$userData = [
				'username'=> $req->body('user'),
				'email' => $req->body('email'),
				'password' => $req->body('password')
			];

			$user = new User($userData);

			$validation = new Validation();
			$validation->body('user')->min(4,'long character')->required('demn');

			echo '<pre>';
			var_dump($validation->run());
		}
    	return $res->render('home');
    }
}