<?php

namespace core;

class Behaviors {
    
    protected $behaviors = [];
            
    public function __construct($behaviors) {
        $this->behaviors = $behaviors;
    }
    
    public function apply($action, $params = []) {
        $result = true;

        foreach ($this->behaviors as $options) {
            $object = $this->getBehavior($options);
            if ($object) {
                $filter = $object->filter($action, $params);
            
                $result = !$filter ? false : $result;
            }
        }
        
        return $result;
    }
    
    public function getBehavior($options = []) {
        $className = $options['class'] ?? '';
        
        if ($className) {
            return new $className($options);
        }
        
        return null;
    }
}