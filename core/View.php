<?php

namespace core;

class View {

    /**
     *
     * @var string
     */
    protected $layout = null;

    protected $viewDir = '';

    protected $html = '';

    protected $currentDir = '';

    /**
     *
     * @param string $layout
     */
    public function __construct(string $layout = '') {
        $this->layout = $layout;

        $this->viewDir = BASE_DIR . DIRECTORY_SEPARATOR . 'view';
        $this->layoutDir = $this->viewDir . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR;

        if ($this->layout && !is_file($this->layoutDir . $this->layout . '.php')) {
            throw new \Exception('Can not find layout "' . $this->layout . '"');
        }

    }

    /**
     * render template without layout
     * @param string $template
     * @param array $params
     * @return string
     * @throws \Exception
     */
    public function renderPart(string $template, array $params = []): string {
        if (substr($template, 0, 1) != '/') {
            $template = $this->currentDir . '/' . $template;
        }

        if (!is_file($this->viewDir . $template . '.php')) {
            throw new \Exception('Can not find "' . $template . '"');
        }

        ob_start();

        if ($params) {
            extract($params);
        }

        include $this->viewDir . $template . '.php';

        return ob_get_clean();
    }

    /**
     * render template in layout
     * @param string $template
     * @param array $params
     * @throws \Exception
     */
    public function renderTemplate(string $template, array $params = []) {
        if (!is_file($this->viewDir . $template . '.php')) {
            throw new \Exception('Can not find "' . $template . '"');
        }

        $this->currentDir = dirname($template);

        ob_start();

        if ($params) {
            extract($params);
        }

        include $this->viewDir . $template . '.php';

        $content = ob_get_clean();

        ob_start();

        include $this->layoutDir . $this->layout . '.php';

        $this->html = ob_get_clean();
    }

    public function getHtml(): string {
        return $this->html;
    }
}