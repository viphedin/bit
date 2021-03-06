<?php

namespace core;


class Session {

    protected static $instance = null;

    protected function __construct() {

    }

    public static function getInstance(): Session {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get(string $name, $default = null) {
        session_start();

        $value = $_SESSION[$name] ?? $default;

        session_write_close();

        return $value;
    }

    public function set(string $name, $value) {
        session_start();

        $_SESSION[$name] = $value;

        session_write_close();
    }

    public function remove(string $name) {
        session_start();

        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }

        session_write_close();
    }
}