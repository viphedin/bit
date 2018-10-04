<?php

class ClassLoader {
   
    protected static $registered = false;

    protected static $paths = [];
    protected static $fileExtension = '.php';

    public static function init() {
        if (!self::$registered) {
            spl_autoload_register(__CLASS__ . '::loadClass');
            self::$registered = true;
        }
    }

    public static function addPath($namespace, $path) {
        self::$paths[$namespace] = $path;
    }

    public static function loadClass($className) {
        if (self::exists($className)) {
            return true;
        }

        $filename = self::findClassFile($className);

        if ($filename) {
            require $filename;

            return self::exists($className);
        } else {
            return false;
        }
    }

    public static function findClassFile($className) {
        foreach (self::$paths as $namespace => $path) {
            $filename = str_replace($namespace, $path, $className) . self::$fileExtension;
            $filename = str_replace('\\', DIRECTORY_SEPARATOR, $filename);

            if (is_file($filename)) {
                return $filename;
            }
        }
        
        return false;
    }

    private static function exists($name, $autoload = false) {
        return class_exists($name, $autoload)
            || interface_exists($name, $autoload)
            || trait_exists($name, $autoload);
    }
}