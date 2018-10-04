<?php

namespace core;

class Route {
    
    protected $controller = null;
    protected $action = null;
    protected $params = null;
    
    protected $object = null;

    /**
     * 
     * @param array $handler
     * @param array $params
     */
    public function __construct($handler, $params = []) {
        $this->controller = $handler[0] ?? null;
        $this->action = $handler[1] ?? null;
        $this->params = $params;
    }
    
    public function runController() {
        if ($this->controller === null) {
            throw new \Exception('Empty controller');
        }

        if ($this->action === null) {
            throw new \Exception('Empty controller action');
        }

        $class = '\\' . App::$app->namespace . '\\controller\\' . $this->controller;
        
        $this->object = new $class($this->params);
        
        if (!method_exists($this->object, $this->action)) {
            throw new \Exception($this->controller . ' has not method ' . $this->action);
        }
        
        $behaviors = new Behaviors($this->object->behaviors());

        if ($behaviors->apply($this->action, $this->params)) {
            return $this->object->{$this->action}();
        } else {
            return null;
        }
    }
}