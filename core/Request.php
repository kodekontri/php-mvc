<?php

namespace app\core;

class Request
{    
    /**
     * Method getPath
	 * 
	 * returns the uri specified in the url
     *
     * @return string '/users'
     */
    public function getUriPath()
    {
    	$path = $_SERVER['REQUEST_URI'] ?? '/';
    	$position = strpos($path, '?');

    	if($position === false){
    		return $path;
    	}

    	return substr($path, 0, $position);
    }
    
    /**
     * Method method
     *
	 * Get the request method (GET or Post)
	 * 
     * @return string
     */
    public function method()
    {
    	return strtolower($_SERVER['REQUEST_METHOD']);
	}
		
	/**
	 * Method isPost
	 *
	 * @return bool
	 */
	public function isPost(){
		return $this->method() === 'post';
	}

	    
    /**
     * Method body
	 * 
	 * returns sanitize request body $_POST
     *
     * @return array
     */
    public function body($name = false)
    {
		$body = [];
		
    	if($this->method() === 'post'){
			if($name) return filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
    		foreach ($_POST as $key => $value) {
    			$body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    		}
    	}

    	return $body;
	}
	
    /**
     * Method query
	 * 
	 * returns sanitize request body $_GET)\
     *
     * @return array
     */
    public function query()
    {
    	$body = [];

    	if($this->method() === 'get'){
    		foreach ($_GET as $key => $value) {
    			$body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    		}
    	}

    	return $body;
    }
}