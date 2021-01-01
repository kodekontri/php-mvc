<?php

/**
 * Class Application
 *
 * @author Roland Marvelous
 * @package MVC
 */

namespace app\core;


class Application
{
    
    /**
     * @var string
     */
    public static string $ROOT_DIR;
    
    /**
     * @var Router
     */
    public Router $router;
    /**
     * @var Request
     */
    public Request $request;
    /**
     * @var Response
     */
    public Response $response;
    /**
     * @var Application
     */
    public static Application $app;
    /**
     * @var Controller
     */
    public Controller $controller;

    /**
     * Constructor
     * 
     * @param mixed $rootPath
     */
    public function __construct($rootPath)
    {
    	self::$ROOT_DIR = $rootPath;
    	self::$app = $this;
   		$this->request = new Request();
   		$this->response = new Response();
       	$this->router = new Router($this->request, $this->response); 
    }


    /**
     * @return Controller
     */
    public function getController()
    {
    	return $this->controller;
    }


    /**
     * @param Controller $controller
     * 
     * @return Controller
     */
    public function setController(Controller $controller)
    {
    	$this->controller = $controller;
    }


    /**
     * @return void
     */
    public function run()
    {
    	echo $this->router->resolve();
    }
}