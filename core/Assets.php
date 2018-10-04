<?php

namespace core;

class Assets {
    
    protected $js = [];
    protected $css = [];

    /**
     * 
     * @param array $js
     * @param array $css
     */
    public function __construct($js = [], $css = []) {
        foreach ($js as $key => $link) {
            $this->registerJs($key, $link);
        }

        foreach ($css as $key => $link) {
            $this->registerCss($key, $link);
        }
    }

    /**
     * 
     * @param string $name
     * @param string $link
     */
    public function registerJs($name, $link) {
        $this->js[$name] = $link;
    }

    /**
     * 
     * @param string $name
     * @param string $link
     */
    public function registerCss($name, $link) {
        $this->css[$name] = $link;
    }
    
    /**
     * 
     * @return string
     */
    public function getHeader() {
        $header = [];

        foreach ($this->css as $name => $link) {
            $header[] = '<link rel="stylesheet" type="text/css" href="' . $link . '" />';
        }

        foreach ($this->js as $name => $link) {
            $header[] = '<script type="text/javascript" src="' . $link . '"></script>';
        }
        
        return join('', $header);
    }
}