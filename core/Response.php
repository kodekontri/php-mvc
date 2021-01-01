<?php 

namespace app\core;

/**
 * Response
 */
class Response
{
    public string $layout = 'main';
    
    /**
     * Method setStatusCode
     *
     * @param int $code status code
     *
     * @return object
     */
    public function setStatusCode(int $code)
    {
		http_response_code($code);
		return $this;
    }

	
	/**
	 * Method setLayout
	 * 
	 * @example setLayout('main')
	 *
	 * @param string $layout layout filename without extension
	 *
	 * @return void
	 */
	public function setLayout(string $layout)
	{
		$this->layout = $layout;
		return $this;
	}
        
    /**
     * Method render
     *
     * @param string $view view file name without extension
     * @param array $params array of params to parse to view
     *
     * @return string html content
     */
    public function render(string $view, array $params=[])
    {
    	$layoutContent = $this->getLayoutContent();
    	$viewContent = $this->renderOnlyView($view, $params);
    	return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    
    
    /**
     * Method getLayoutContent
     *
     * @return string layout html content
     */
    protected function getLayoutContent()
    {
		try {
			$layout = $this->layout;
			$layoutPath = Application::$ROOT_DIR."/views/layout/$layout.php";
			if (!file_exists($layoutPath)) {
				throw new \Exception("<strong>Layout File Not Found:</strong> '$layout' not found");	
			}
			ob_start();
			include_once $layoutPath;
			return ob_get_clean();
		} catch (\Exception $e) {
			echo $this->renderException($e);
		}
    }
    
        
    /**
     * Method renderText
	 * 
	 * render text with layout
     *
     * @param string $text text to be rendered
     *
     * @return void
     */
    public function renderText(string $text){
    	$layoutContent = $this->getLayoutContent();
    	return str_replace('{{content}}', $text, $layoutContent);
    }
        
    /**
     * Method renderOnlyView
     *
	 * Renders only view without layout
	 * 
     * @param string $view
     * @param array $params
     *
     * @return string
     */
    protected function renderOnlyView(string $view, $params=[])
    {
    	extract($params);
    	$layoutPath = Application::$ROOT_DIR."/views/$view.php";
    	if (!file_exists($layoutPath)) {
    		throw new \Exception("View '$view' not found");
    	}
    	ob_start();
        include_once $layoutPath;
        return ob_get_clean();
	}
	
	public function renderException(\Exception $err){
		$params = [
			'message' => $err->getMessage(),
			'file' => $err->getFile(),
			'line' => $err->getLine(),
			'trace' => $err->getTrace(),
			'code' => $err->getCode()
		];
		return $this->renderOnlyView('error', $params);;
	}
}