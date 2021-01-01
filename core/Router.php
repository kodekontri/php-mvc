<?php

/**
 * Class Router
 *
 * @author Roland Marvelous
 * @package MVC
 */

namespace app\core;

use app\core\Request;
use app\core\Response;

class Router
{
	public array $routes = [];
    
    /**
     * Method __construct
     *
     * @param Request $request]
     * @param Response $respons
     *
     * @return void
     */
    public function __construct(Request $request, Response $response)
    {
    	$this->request = $request;
    	$this->response = $response;
    }
    
    
    /**
     * Method get
     *
     * @param string $path
     * @param mixed $callback
     *
     * @return void
     */
    public function get(string $path, $callback)
    {
       $this->routes['get'][$path] = $callback;
    }
    
    /**
     * Method post
     *
     * @param string $path
     * @param $callback $callback
     *
     * @return void
     */
    public function post(string $path, $callback)
    {
       $this->routes['post'][$path] = $callback;
    }
    
    /**
     * Method resolve
	 * 
	 * handles the request and calls the route controller
     *
     * @return void
     */
    public function resolve()
    {
    	$path = $this->request->getUriPath();
       $method = $this->request->method();
		$callback = $this->routes[$method][$path] ?? false;
      
      
    	if($callback === false){
         $this->response->setStatusCode(404);
         $callback = $this->routes['get']['404'] ?? false;
         
       }
       
		if($callback === false){
            return $this->response->renderText("Page Not Found");
      }

    	if(is_string($callback)){
    		return $this->response->render($callback);
    	}

    	if(is_array($callback)){
    		Application::$app->setController(new $callback[0]());
    		$callback[0] = Application::$app->getController();
    	}

    	return call_user_func($callback, $this->request, $this->response);
    }
}