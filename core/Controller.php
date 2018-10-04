<?php

namespace core;

abstract class Controller {

    /**
     *
     * @var array
     */
    protected $params = [];

    /**
     * controller layout
     * @var string
     */
    protected $layout = 'default';

    /**
     *
     * @param array $params
     */
    public function __construct($params = []) {
        $this->params = $params;
    }

    /**
     *
     * @return array
     */
    public function behaviors() {
        return [];
    }

    /**
     * render view for output
     * @param string $template
     * @param array $options
     */
    public function render($template, $options = []) {
        $view = new View($this->layout);

        if (substr($template, 0, 1) != '/') {
            $path = explode('\\', get_class($this));
            $name = array_pop($path);

            $template = '/' . preg_replace('/controller$/', '', strtolower($name)) . '/' . $template;
        }

        $view->renderTemplate($template, $options);

        return $view;
    }
}