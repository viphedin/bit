<?php

namespace core;

class Router {

    /**
     * 
     * @var array
     */
    protected $routes = [];
    
    /**
     * 
     * @param array $routes
     */
    public function __construct($routes = []) {
        if (is_array($routes)) {
            foreach ($routes as $route => $controller) {
                $this->addRoute($route, $controller);
            }
        }
    }
    
    /**
     * 
     * @param string $route
     * @param array $controller
     */
    public function addRoute($route, $controller) {
        $this->routes[$route] = $controller;
    }

    /**
     * 
     * @param mixed $requestUrl
     * @return \core\Route
     */
    public function match($requestUrl = null) {
        $matched = false;

        if ($requestUrl === null) {
            $requestUrl = App::$app->request->getRequestUrl(true);
        } elseif (!is_arry($requestUrl)) {
            $requestUrl = parse_url($requestUrl);
        }

        foreach($this->routes as $route => $handler) {
            $routePattern = $this->makePattern($route);

            $params = [];

            $match = preg_match('~^' . $routePattern . '$~u', $requestUrl['path'], $params);

            if ($match && $params) {
                return new Route($handler, $this->cleanParams($params));
            }
        }
        
        return $matched;
    }
    
    protected function makePattern($route) {
        if (preg_match_all('/(\/|\.|)\[(?::([^:\]]*+))?\]/iU', $route, $matches, PREG_SET_ORDER)) {
            foreach($matches as $match) {
                list($block, $pre, $param) = $match;

                $pre = $pre == '.' ? '\\.' : ($pre ?? null);

                $pattern = '(?:' . $pre . '(' . ($param ? '?P<' . $param . '>' : null) . '.+))';

                $route = str_replace($block, $pattern, $route);
            }
        }
        
        return $route;
    }
    
    protected function cleanParams($params) {
        foreach ($params as $key => $value) {
            if (is_numeric($key)) {
                unset($params[$key]);
            }
        }

        return $params;
    }
}