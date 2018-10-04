<?php

namespace core;

abstract class Widget {

    public static function widget($params = []) {
        $class = get_called_class();
        $object = new $class();

        return $object->run($params);
    }

    abstract public function run($params = []);

    public function render($options) {
        $view = new View();

        $path = explode('\\', get_class($this));

        $name = array_pop($path);

        $template = '/widget/' . strtolower($name);

        return $view->renderPart($template, $options);
    }
}