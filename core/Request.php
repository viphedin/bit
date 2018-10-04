<?php

namespace core;

class Request {
    
    /**
     * 
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name = null, $default = null) {
        if ($name === null) {
            return $_GET;
        }
        
        return $_GET[$name] ?? $default;
    }

    /**
     * 
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function post($name = null, $default = null) {
        if ($name === null) {
            return $_POST;
        }
        
        return $_POST[$name] ?? $default;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    public function file($name = null) {
        if ($name === null) {
            return $_FILES;
        }
        
        return $_FILES[$name] ?? null;
    }
    
    /**
     * 
     * @param bool $asArray
     */
    public function getRequestUrl($asArray = false) {
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        
        if ($asArray) {
            $url = parse_url($url);
        }
        
        return $url;
    }

    /**
     * 
     * @return string
     */
    public function getType() {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * 
     * @return string
     */
    public function isPost() {
        return $this->getType() == 'POST';
    }
}