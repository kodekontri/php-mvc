<?php 

namespace app\core;

class Validation 
{      
    /**
     * @var array
     */
    private array $errors = [];

    /**
     * @var string
     */
    public string $field;
    
    /**
     * value
     *
     * @var mixed
     */
    private $value;

    /**
     * @var mixed
     */
    public $message;
    
    /**
     * Method body
     *
     * @param string $body
     * @param string $message
     *
     * @return object
     */
    public function body(string $field, string $message = null): object
    {
        $this->field = $field;
        $this->message = $message;
        $this->value =  Application::$app->request->body($field);
        return $this;
    }
    
    /**
     * Method required
     *
     * @param string $message
     *
     * @return object
     */
    public function required(string $message = null): object
    {
        if($message) $this->message = $message;
        
        if(empty($this->value)){
            $error = [
                'field' => $this->field,
                'value' => $this->value,
                'message' => $this->message ?? $message ?? "$this->field field is required"
            ];
            
            $this->errors[$this->field] = $error;
        }

        return $this;
    }
     
     /**
      * Method min
      *
      * @param int
      * @param string $message
      *
      * @return object
      */
     public function min(int $param, string $message = null): object
    {
        if($message) $this->message = $message;
        
        if(strlen($this->value) < $param){
            $error = [
                'field' => $this->field,
                'value' => $this->value,
                'message' => $this->message ?? $message ?? "$this->field field character must be atleast $param characters"
            ];
            
            $this->errors[$this->field] = $error;
        }

        return $this;
    }
       
     public function max(int $param, string $message = null): object
    {
        if($message) $this->message = $message;
        
        if(strlen($this->value) > $param){
            $error = [
                'field' => $this->field,
                'value' => $this->value,
                'message' => $this->message ?? $message ?? "$this->field field character must not be greater than $param characters"
            ];
            
            $this->errors[$this->field] = $error;
        }

        return $this;
    }
       
    /**
     * Method setMessage
     *
     * @param string $message
     *
     * @return void
     */
    public function setMessage(string $message = null){
        $this->message = $message;
    }
    
    /**
     * Method reset
     *
     * @return void
     */
    public function reset()
    {
        $this->message = null;
        $this->field = null;
        $this->value = null;
    }
        
    /**
     * Method validate
     *
     * @return bool
     */
    public function run(): array
    {
        return $this->errors;
    }
}
