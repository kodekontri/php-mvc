<?php 
namespace app\core;

class Model
{
    public function __construct(array $data = []) {
        if(!empty($data)){
            foreach($data as $property => $value){
                if(property_exists($this,$property)){
                    $this->$property = $value;
                }
            }
        }
    }
}
