<?php

namespace core;

class App {
    public static $app = null;

    protected $params = null;
    protected $session = null;
    protected $request = null;
    protected $assets = null;
    protected $router = null;
    protected $auth = null;
    protected $db = null;

    protected $namespace = 'app';

    protected function __construct(array $config = []) {
        $this->namespace = $config['namespace'] ?? $this->namespace;

        $this->session = Session::getInstance();

        $components = $config['components'] ?? [];

        $this->auth = new Auth($components['auth'] ?? [], $this->session);

        $this->params = $config['params'] ?? [];

        if (isset($components['db'])) {
            $this->db = new \PDO($components['db']['dsn'] ?? '',  $components['db']['user'] ?? '', $components['db']['password'] ?? '');
        }

        $this->request = new Request();

        $this->assets = new Assets($components['assets']['js'] ?? [], $components['assets']['css'] ?? []);

        $this->router = new Router($components['routes'] ?? []);
    }

    /**
     *
     * @param array $config
     */
    public static function run(array $config = []) {
        if (self::$app === null) {
            self::$app = new App($config);
        }

        self::$app->auth->checkStored();

        $route = self::$app->router->match();

        if ($route) {
            $result = $route->runController();

            if ($result instanceof \core\View) {
                echo $result->getHtml();
            } elseif ($result instanceof \core\Response\Custom) {
                $result->response();
            } elseif (is_string($result)) {
                header('Location: ' . $result);
            }
        }
    }

    public function getSession(): Session {
        return $this->session;
    }

    public function getRequest(): Request {
        return $this->request;
    }

    public function getAssets(): Assets {
        return $this->assets;
    }

    public function getAuth(): Auth {
        return $this->auth;
    }

    public function getDb(): \PDO {
        return $this->db;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}